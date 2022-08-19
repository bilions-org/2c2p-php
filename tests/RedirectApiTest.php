<?php

use CCPP\BaseUrl;
use CCPP\Config;
use CCPP\Locale;
use CCPP\PaymentChannel;
use CCPP\RedirectApi;
use CCPP\Requests\RedirectApiRequest;
use PHPUnit\Framework\TestCase;

final class RedirectApiTest extends TestCase {
  /**
   * @before
   */
  public function prepareConfig() {
    $config               = Config::init();
    $config->merchantId   = 'JT02';
    $config->secretKey    = '72B8F060B3B923E580411200068A764610F61034AE729AB9EF20CAFF93AFA1B9';
    $config->currencyCode = 'MMK';
    $config->locale       = Locale::MYANMAR;
    $config->baseUrl      = BaseUrl::SANDBOX;
  }

  public function testRedirectUri(): void {
    $payload                    = new RedirectApiRequest();
    $payload->amount            = 10000;
    $payload->frontendReturnUrl = 'https://example.com/';
    $payload->description       = 'Invoice Description';
    $payload->invoiceNo         = uniqid();
    $payload->paymentChannel    = [PaymentChannel::KBZ_PAY];
    $payload->customerName      = 'Zin Kyaw Kyaw';
    $payload->customerEmail     = 'necessarylion@gmail.com';

    $payment = new RedirectApi();
    $url     = $payment->getUrl($payload);
    $this->assertEquals('string', gettype($url));

    $paymentToken = $payment->paymentToken();
    $this->assertEquals('string', gettype($paymentToken));

    $result = $payment->inquiryPayment();
    $this->assertEquals('CCPP\Responses\PaymentInquiryResponse', get_class($result));

    $status = $payment->inquiryStatus();
    $this->assertEquals(false, $status);
  }
}