# Payabl. PHP-SDK

### API Reference
https://docs.payabl.com/docs/getting-started

#### Version (BETA)
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
$cardDetails = [
    "cardholder_name" => "John Doe",
    "ccn" => "5413530000000501",
    "exp_month" => "12",
    "exp_year" => "2040",
    "cvc_code" => "196",
];
$customerData = [
    "customerip" => "127.0.1.1",
    "email" => "john_doe@gmail.com",
    "firstname" => "John",
    "lastname" => "Doe",
    "language" => "de",
];
$customerAddress = [
    "company" => "test SDK",
    "country" => "DEU",
    "city" => "Wiesbaden",
    "state" => "HE",
    "street" => "Wilhelm str 15",
    "zip" => "65197",
];
$customerOrder = [
    "amount" => 3.14,
    "orderid" => "123",
    "currency" => "EUR",
    "payment_method" => 1,
];
$payabl->setCardDetails($cardDetails);
$payabl->setCustomerData($customerData );
$payabl->setCustomerAddress($customerAddress);
$payabl->setCustomerOrder($customerOrder);

$transaction = $payabl->payment()->payNow();

// refund
$refundParams = [
    "transactionid"=> $transaction->transactionid,
    "amount"=> 2.7,
    "currency"=> "EUR",
];
$result = $payabl->transaction($transaction)->refund($refundParams);

// Pre-Authorization and capture
$transactionDelay = $payabl->payment()->payDelay($paymentParams);
$result = $payabl->transaction($transaction)->capture();

// Pre-Authorization and cancel
$transactionDelay = $payabl->payment()->payDelay($paymentParams);
$result = $payabl->transaction($transaction)->cancel();


```