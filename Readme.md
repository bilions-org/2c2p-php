<img src="https://2c2p.com/assets/images/2C2P_Logo_RGB_Dark_Green-01.png" alt="2c2p" width="100"/>


# 2c2p-PHP Library <img src="https://www.php.net//images/logos/new-php-logo.svg" alt="2c2p" width="50"/>

## Usage

#### Step 1. Setup 2c2p Credentials  
```
use CCPP\Config;
use CCPP\Locale;

$config               = Config::init();
$config->merchantId   = 'JT02';
$config->secretKey    = '72B8F060B3B923E580411200068A764610F61034AE729AB9EF20CAFF93AFA1B9';
$config->currencyCode = 'MMK';
$config->locale       = Locale::MYANMAR;
$config->baseUrl      = BaseUrl::SANDBOX;
```

#### Step 2. Prepare redirect API request payload
```
use CCPP\Requests\RedirectApiRequest;

$invoiceNo = uniqid(); // Your invoice Number

$request                    = new RedirectApiRequest();
$request->amount            = 10000;
$request->frontendReturnUrl = 'https://example.com/';
$request->description       = 'Invoice Description';
$request->invoiceNo         = $invoiceNo;
$request->paymentChannel    = [PaymentChannel::CREDIT_CARD];
$request->customerName      = 'Zin Kyaw Kyaw';
$request->customerEmail     = 'necessarylion@gmail.com';

```

#### Step 3. Get redirect Url
```
use CCPP\RedirectApi;

$payment = new RedirectApi();
$url     = $payment->getUrl($request);
```

#### Step 4. Store payment token and invoiceNo in your database
```
$paymentToken = $payload->paymentToken();
```

#### Step 5. On frontendReturnUrl inquiry payment using paymentToken and invoiceNo
```
$result = $payment->inquiryPayment(); // return PaymentInquiryResponse
$success = $payment->inquiryStatus(); // return boolean (true or false)
```

#### Other additional helpful functions
- `$payment->response()` get full api response
