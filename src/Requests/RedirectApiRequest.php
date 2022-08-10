<?php
namespace CCPP\Requests;

use CCPP\Config;

class RedirectApiRequest extends Request {
  public $frontendReturnUrl;
  public $backendReturnUrl;
  public $invoiceNo   = '';
  public $description = '';
  public $amount;
  public $paymentChannel = ['ALL'];
  public $customerName;
  public $customerEmail;
  public $payload;

  public function toArray() {
    $config  = Config::init();
    $payload = [
      'merchantID'        => $config->merchantId,
      'currencyCode'      => $config->currencyCode,
      'frontendReturnUrl' => $this->frontendReturnUrl,
      'backendReturnUrl'  => $this->backendReturnUrl,
      'invoiceNo'         => $this->invoiceNo,
      'description'       => $this->description,
      'amount'            => $this->amount,
      'paymentChannel'    => $this->paymentChannel,
      'locale'            => $config->locale,
    ];
    if ($this->customerName || $this->customerEmail) {
      $payload['uiParams'] = [
        'userInfo' => [
          'name'  => $this->customerName, 
          'email' => $this->customerEmail, 
        ],
      ];
    }
    return $payload;
  }
}