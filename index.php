<?php


require_once 'src/Payabl.php';
require 'vendor/autoload.php';

use PayableSdkPhp\Payabl;

$payabl = new Payabl();
$paymentParams = [
    "amount"=> 33.33,
    "orderid"=> "123",
    "currency"=> "EUR",
    "payment_method"=> 1,

    "cardholder_name"=> "Nikita Pushkar",
    "ccn"=> "5413530000000501",
    "exp_month"=> "12",
    "exp_year"=> "2040",
    "cvc_code"=> "196",

    "customerip"=> "127.0.1.1",
    "email"=> "nikita.pushka@payable.com",
    "firstname"=> "Nikita",
    "lastname"=> "Pushkar",
    "language"=> "de",

    "company"=> "Powerpay21",
    "country"=> "DEU",
    "city"=> "Wiesbaden",
    "state"=> "HE",
    "street"=> "Wald str",
    "zip"=> "65197",

];

$transaction = $payabl->payment()->payNow($paymentParams);
dump($transaction);
die();



