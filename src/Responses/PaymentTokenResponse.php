<?php
namespace CCPP\Responses;

class PaymentTokenResponse {
  public $redirectUrl;
  public $paymentToken;
  public $success;

  public static function from($result) {
    $response               = new Self();
    $response->redirectUrl  = $result->webPaymentUrl;
    $response->paymentToken = $result->paymentToken;
    $response->success      = $result->respDesc == '0000' ? true : false;
    return $response;
  }
}