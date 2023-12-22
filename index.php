<?php


require_once 'src/Payabl.php';
require 'vendor/autoload.php';

use PayableSdkPhp\Payabl;

$payabl = new Payabl();
$paymentParams = [
    "amount"=> 3.14,
    "orderid"=> "123",
    "currency"=> "EUR",
    "payment_method"=> 1,

    "cardholder_name"=> "John Doe",
    "ccn"=> "5413530000000501",
    "exp_month"=> "12",
    "exp_year"=> "2040",
    "cvc_code"=> "196",

    "customerip"=> "127.0.1.1",
    "email"=> "john_doe@gmail.com",
    "firstname"=> "John",
    "lastname"=> "Doe",
    "language"=> "de",

    "company"=> "horns and hooves",
    "country"=> "DEU",
    "city"=> "Wiesbaden",
    "state"=> "HE",
    "street"=> "Wilhelm str 15",
    "zip"=> "65197",
];

$transaction = $payabl->payment()->payNow($paymentParams);
dump($transaction);
sleep(1);
$refundParams = [
    "transactionid"=> $transaction->transactionid,
    "amount"=> 2.7,
    "currency"=> "EUR",
];
$refund = $payabl->refund()->refundNow($refundParams);
dump("REFUND");
dump($refund);
die();



