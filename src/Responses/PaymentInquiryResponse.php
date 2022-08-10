<?php
namespace CCPP\Responses;

class PaymentInquiryResponse {
  public $cardNo;
  public $cardToken;
  public $loyaltyPoints;
  public $merchantID;
  public $invoiceNo;
  public $amount;
  public $monthlyPayment;
  public $userDefined1;
  public $userDefined2;
  public $userDefined3;
  public $userDefined4;
  public $userDefined5;
  public $currencyCode;
  public $recurringUniqueID;
  public $tranRef;
  public $referenceNo;
  public $approvalCode;
  public $eci;
  public $transactionDateTime;
  public $agentCode;
  public $channelCode;
  public $issuerCountry;
  public $issuerBank;
  public $installmentMerchantAbsorbRate;
  public $paymentScheme;
  public $respCode;
  public $respDesc;

  public static function from($array) {
    $response = new Self();
    foreach ($array as $key => $value) {
      $response->{$key} = $value;
    }
    return $response;
  }
}