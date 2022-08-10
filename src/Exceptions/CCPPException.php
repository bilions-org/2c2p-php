<?php
namespace CCPP\Exceptions;

use Exception;
use CCPP\ResponseCode;

class CCPPException extends Exception {
  public function __construct($code = 500) {
    parent::__construct(ResponseCode::get($code));
  }
}