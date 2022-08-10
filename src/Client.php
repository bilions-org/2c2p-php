<?php
namespace CCPP;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CCPP\Requests\Request;
use CCPP\Exceptions\HttpException;

class Client {
  public static function http($method, $url, Request $request) {
    $config  = Config::init();
    $url     = rtrim($config->baseUrl, '/') . '/' . ltrim($url, '/');
    $payload = $request->toArray();

    Logger::debug($url);
    Logger::debug('PAYLOAD =>', $payload);

    $jwt     = self::encode($payload);
    $payload = ['payload' => $jwt];
    $params  = json_encode($payload);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if (strtolower($method) == 'post') {
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, self::getHeaders());
    $response = curl_exec ($ch);
    if ($response === false) {
      $error = curl_error($ch);
      curl_close($ch);
      throw new HttpException($error);
    }
    curl_close ($ch);
    return json_decode($response);
  }

  private static function getHeaders() {
    return [
      'Accept: text/plain',
      'Content-Type: application/*+json',
    ];
  }

  private static function encode($payload) {
    $config = Config::init();
    return JWT::encode($payload, $config->secretKey, 'HS256');
  }

  public static function decode($payload) {
    $config = Config::init();
    return JWT::decode($payload, new Key($config->secretKey, 'HS256'));
  }
}