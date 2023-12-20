<?php

namespace Payabl;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Payabl{


    private string $secret;
    private string $merchantId;
    private float $amount;
    private string $currency;
    private string $cardholderName;
    private string $ccn;
    private string $company;
    private string $country;
    private string $customerIp;
    private string $orderId;
    private string $cvcCode;
    private string $email;
    private string $expMonth;
    private string $expYear;
    private string $firstname;
    private string $lastname;
    private int $paymentMethod;

    private string $city;
    private string $state;
    private string $street;
    private string $zip;
    private string $language;

    private Client  $client;


    public function __construct( string $secret)
    {
        $this->client = new Client();
        $this->secret = $secret;
    }
    public function setMerchantId(string $merchantId): void {
        $this->merchantId = $merchantId;
    }


    public function generateSignature(): string {

        $params = $this->prepareArray();
        // Сортируем параметры по ключам в алфавитном порядке
        ksort($params);

        // Конкатенируем значения параметров
        $concatenatedParams = implode('', array_values($params));

        // Добавляем секрет к концу строки
        $concatenatedParams .= $this->secret;

        // Вычисляем SHA-1 хеш строки и приводим его к нижнему регистру
        return strtolower(sha1($concatenatedParams));
    }


    public function authorizationCreditCard(){
        try {
            $response = $this->client->request('POST', 'http://172.25.50.40:19700/powercash21-3-2/backoffice/payment_authorize', [
                'headers' => [
                    'Accept' => 'text/plain',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => $this->getArrayWithSignature()
            ]);
            echo "\n";
            echo $response->getBody();
            echo "\n";
        } catch (GuzzleException $e) {
            echo "Guzzle Error: " . $e->getMessage();
        }
        return $response;
    }
    public function preAuthorizationCreditCard(){
        try {
            $response = $this->client->request('POST', 'http://172.25.50.40:19700/powercash21-3-2/backoffice/payment_preauthorize', [
                'headers' => [
                    'Accept' => 'text/plain',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => $this->getArrayWithSignature()
            ]);
            echo "\n";
            echo $response->getBody();
            echo "\n";
        } catch (GuzzleException $e) {
            echo "Guzzle Error: " . $e->getMessage();
        }
    }

    public function setAmount(float $amount): void {
        $this->amount = $amount;
    }



    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function setPaymentMethod(int $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function setCardholderName(string $cardholderName): void
    {
        $this->cardholderName = $cardholderName;
    }

    public function setCcn(string $ccn): void
    {
        $this->ccn = $ccn;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function setCustomerIp(string $customerIp): void
    {
        $this->customerIp = $customerIp;
    }

    public function setCvcCode(string $cvcCode): void
    {
        $this->cvcCode = $cvcCode;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setExpMonth(string $expMonth): void
    {
        $this->expMonth = $expMonth;
    }

    public function setExpYear(string $expYear): void
    {
        $this->expYear = $expYear;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function setOrderId(string $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getArrayWithSignature():array
    {
        $arr = $this->prepareArray();
        $arr['signature'] = $this->generateSignature();
        return $arr;
    }

    private function prepareArray():array {
        return [
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
    }
}


