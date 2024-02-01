# Payabl. PHP-SDK

### API Reference
https://docs.payabl.com/docs/getting-started

#### Version
0.0.2

## Installation
```bash 
composer require payabl/pb_php_sdk
```

## Usage

```PHP
use PayablSdkPhp\Payabl;
$payabl = new Payabl();
$cardDetails = [
    "cardholder_name" => "John Doe",
    "ccn" => "5413530000000501",
    "exp_month" => "12",
    "exp_year" => "2040",
    "cvc_code" => "196",
    "payment_method" => 1,
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

];
$payabl->setCardDetails($cardDetails);
$payabl->setCustomerData($customerData );
$payabl->setCustomerAddress($customerAddress);
$payabl->setCustomerOrder($customerOrder);
$payabl->setMerchantData($merchantData);
$payabl->setShippingData($shippingData);
$payabl->setBillingData($billingData);

$transaction = $payabl->getPaymentResource()->payNow();
```


### Refund

```php
$refundParams = [
    "transactionid"=> $transaction->transactionid,
    "amount"=> 2.7,
    "currency"=> "EUR",
];
$result = $payabl->getTransactionResource($transaction)->refund($refundParams);
```

### Pre-Authorization and capture

```php
$transactionDelay = $payabl->getPaymentResource()->payDelay($paymentParams);
$result = $payabl->getTransactionResource($transaction)->capture();
```

### Pre-Authorization and cancel

```php

$transactionDelay = $payabl->getPaymentResource()->payDelay($paymentParams);
$result = $payabl->getTransactionResource($transaction)->cancel();
```


### get Session ID

```PHP
... 
$merchantData = [
    "shopUrl"=>"https://127.0.0.1",
    "notificationUrl"=>"https://127.0.0.1",
];

$payabl->setMerchantData($merchantData);
$transaction = $payabl->getPaymentResource()->getPaymentWidgetSession();
```