<?php


require_once 'src/Payabl.php';
require 'vendor/autoload.php';

use Payabl\Payabl;

echo "\n";
echo "===\n";
echo "\n";

$merchandId = "nPushkar_test";
$secret  = "2625";

$amount=20.12;

$cardholderName="Nikita Pushkar";
$ccn="5413530000000501";
$expMonth="12";
$expYear="2040";
$cvcCode="196";

$city="Frankfurt";
$company="Powerpay21";
$country="DEU";
$currency="EUR";
$customerIp="127.1.1.1";

$email="nikita.pushkar@payable.com";

$firstname="Nikita";
$lastname="Pushkar";
$language="de";

$orderId="123";
$paymentMethod=1;
$street="Wald str";
$zip="65197";
$city= "Wiesbaden";
$state = "HE";

$payabl = new Payabl($secret);

$payabl->setMerchantId('nPushkar_test');

$payabl->setAmount($amount);
$payabl->setCardholderName($cardholderName);
$payabl->setCcn($ccn);
$payabl->setExpMonth($expMonth);
$payabl->setExpYear($expYear);
$payabl->setCvcCode($cvcCode);

$payabl->setOrderId($orderId);
$payabl->setPaymentMethod($paymentMethod);
$payabl->setCurrency($currency);

$payabl->setCity($city);
$payabl->setCompany($company);
$payabl->setCountry($country);
$payabl->setCustomerIp($customerIp);
$payabl->setStreet($street);
$payabl->setState($state);
$payabl->setZip($zip);


$payabl->setEmail($email);
$payabl->setFirstname($firstname);
$payabl->setLastname($lastname);
$payabl->setLanguage($language);




$signature = $payabl->generateSignature();
$arr = $payabl->getArrayWithSignature();
foreach ($arr as $item ){
    echo $item."\n";
}

echo "Generated Signature: " . $signature . "\n";




$transaction = $payabl->authorizationCreditCard();

$transaction2 = $payabl->preAuthorizationCreditCard();
///////////////////////////



$payabl = new Payabl($secret);
$paymentParams = [
    'merchantid' => $this->merchantId,
    'orderid' => $this->orderId,
    'amount' => $this->amount,
    'currency' => $this->currency,
    'payment_method' => $this->paymentMethod,
    'ccn' => $this->ccn,
    'exp_month' => $this->expMonth,
    'exp_year' => $this->expYear,
    'cvc_code' => $this->cvcCode,
    'cardholder_name' => $this->cardholderName,
    'language' => $this->language,
    'email' => $this->email,
    'customerip' => $this->customerIp,
    'firstname' => $this->firstname,
    'lastname' => $this->lastname,
    'street' => $this->street,
    'zip' => $this->zip,
    'city' => $this->city,
    'state' => $this->state,
    'country' => $this->country,
];


try {
    //  оплата сразу
    $transaction = $payabl->payment()->payNow($paymentParams);
    // refund
    $refund = $payabl->payment()->makeRefund($transaction);

    // оплата с задержкой
    $transaction = $payabl->payment()->payLater($paymentParams);
    $payabl->payment()->capture($transaction);

    // если capture не было то можно отменить
    $payabl->payment()->cancel($transaction);


} catch (PayablException $e){
    // ...
}

try {
    $transaction = $payabl->buyticket()->buy("wrong resourse ");
} catch (PaybleException $e){
    // ...
}



