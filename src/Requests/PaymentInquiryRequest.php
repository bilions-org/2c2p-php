<?php
namespace CCPP\Requests;

use CCPP\Config;

class PaymentInquiryRequest extends Request {
  public $paymentToken;
  public $invoiceNumber;

  public function toArray() {
    $config = Config::init();
    return [
      'payload'    => $this->paymentToken,
      'merchantID' => $config->merchantId,
      'invoiceNo'  => $this->invoiceNumber,
      'locale'     => $config->locale,
    ];
  }
}