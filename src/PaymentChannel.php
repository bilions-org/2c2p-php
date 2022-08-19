<?php
namespace CCPP;

class PaymentChannel {
  CONST ALL                  = 'ALL';
  CONST CREDIT_CARD          = 'CC';
  CONST QR_CODE              = 'QR';
  CONST KBZ_PAY              = 'KBZQR';
  CONST PROMPT_PAY           = 'PPQR';
  CONST WEB_PAY              = 'WEBPAY';
  CONST COUNTER              = 'COUNTER';
  CONST SELF_SERVICE_MACHINE = 'SSM';
  CONST INTERNET_BANKING     = 'IMBANK';
  CONST BUY_NOW_PAY_LATER    = 'BNPL';
  CONST GLOBAL_INSTALLMENT   = 'GCARD';
  CONST DEEP_LINK            = 'DEEPLINK';
  CONST LOCAL_INSTALLMENT    = 'LCARDIPP';
  CONST THIRD_PARTY_GLOBAL   = 'GTPTY';
  CONST THIRD_PARTY_LOCAL    = 'LCARD';
}