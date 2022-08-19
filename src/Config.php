<?php
namespace CCPP;

class Config {
  public $merchantId;

  public $secretKey;

  public $locale;

  public Bool $debug = false;

  public String $currencyCode = 'MMK';

  public $baseUrl = 'https://pgw.2c2p.com/payment/4.1';

  private static Config|Null $instance = null;

  public static function init() {
    if (self::$instance == null) {
      self::$instance = new Config();
    }
    return self::$instance;
  }
}