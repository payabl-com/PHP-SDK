# Payabl. PHP-SDK

### API Reference
https://docs.payabl.com/docs/getting-started

#### Version 0.1 (BETA)
##### Do not use in PROD
last update 22.12.2023

#### Installation: 
```bash 
composer require payabl/pb_php_sdk
```

#### Usage Example: 
```php

use PayablSdkPhp\Payabl;

$payabl = new Payabl();
$paymentParams = [
    "amount"=> 3.14,
    "orderid"=> "123",
    "currency"=> "EUR",
    "payment_method"=> 1,

    "cardholder_name"=> "John Doe",
    "ccn"=> "4242424242424242",
    "exp_month"=> "12",
    "exp_year"=> "2040",
    "cvc_code"=> "123",

    "customerip"=> "127.0.1.1",
    "email"=> "john_doe@gmail.com",
    "firstname"=> "John",
    "lastname"=> "Doe",
    "language"=> "de",

    "company"=> "test php SDK",
    "country"=> "DEU",
    "city"=> "Wiesbaden",
    "state"=> "HE",
    "street"=> "Wilhelm str 15",
    "zip"=> "65000",
];

$transaction = $payabl->payment()->payNow($paymentParams);

$refundParams = [
    "transactionid"=> $transaction->transactionid,
    "amount"=> 2.7,
    "currency"=> "EUR",
];
$refund = $payabl->refund()->refundNow($refundParams);
```