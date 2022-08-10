<?php
namespace CCPP;

use CCPP\Exceptions\CCPPException;
use CCPP\Requests\RedirectApiRequest;
use CCPP\Requests\PaymentInquiryRequest;
use CCPP\Responses\PaymentTokenResponse;
use CCPP\Responses\PaymentInquiryResponse;

class RedirectApi extends Client {
  public $request;

  public $response;

  public function getUrl(RedirectApiRequest $request) {
    $this->request = $request;
    $res           = $this->http('POST', 'PaymentToken', $this->request);
    Logger::debug('RESULT => ', $res);
    if (empty($res->payload)) {
      throw new CCPPException($res->respCode);
    }
    $decoded            = $this->decode($res->payload);
    $this->response     = PaymentTokenResponse::from($decoded);
    $this->paymentToken = $this->response->paymentToken;
    return $this->response->redirectUrl;
  }

  public function inquiryPayment($paymentToken = null, $invoiceNo = null) {
    $token         = !empty($paymentToken) ? $paymentToken : $this->paymentToken();
    $invoiceNumber = !empty($invoiceNo) ? $invoiceNo : $this->request->invoiceNo;

    $request                = new PaymentInquiryRequest();
    $request->paymentToken  = $token;
    $request->invoiceNumber = $invoiceNumber;

    $res = $this->http('POST', 'PaymentInquiry', $request);
    if (empty($res->payload)) {
      throw new CCPPException($res->respCode);
    }
    $result         = $this->decode($res->payload);
    $this->response = PaymentInquiryResponse::from($result);
    return $this->response;
  }

  public function inquiryStatus() {
    if ($this->response->respCode && $this->response->respCode == '0000') {
      return true;
    }
    return false;
  }

  public function paymentToken() {
    return $this->paymentToken;
  }

  public function response() {
    return $this->response;
  }
}