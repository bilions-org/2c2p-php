<?php
namespace CCPP;

class Config {
  public $merchantId;

  public $secretKey;

  public $locale;

  public $debug = false;

  public $currencyCode = 'MMK';

  public $baseUrl = 'https://sandbox-pgw.2c2p.com/payment/4.1';

  private static $instance = null;

  public static function init() {
    if (self::$instance == null) {
      self::$instance = new Config();
    }
    return self::$instance;
  }
}