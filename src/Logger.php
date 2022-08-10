<?php
namespace CCPP;

class Logger {
  public static function debug() {
    $config = Config::init();
    $debug  = $config->debug;
    if ($debug) {
      $args = func_get_args();
      self::log($args, "\033[33m");
    }
  }

  public static function info() {
    $args = func_get_args();
    self::log($args);
  }

  public static function log($args, $color = null) {
    foreach ($args as $data) {
      $type = gettype($data);
      if ($type == 'string') {
        echo ($color ? $color : "\033[32m") . $data . "\033[0m" . PHP_EOL;
      } else if ($type == 'boolean') {
        echo "\033[91m" . ($data ? 'true' : 'false') . "\033[0m" . PHP_EOL;
      } else {
        echo "\033[34m";
        print_r($data) . PHP_EOL;
        echo  "\033[0m";
      }
    }
  }
}
