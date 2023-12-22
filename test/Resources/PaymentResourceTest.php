<?php

namespace Resources;



use PayableSdkPhp\DTO\Responses\PaymentResults;
use PayableSdkPhp\Exceptions\PayablException;
use PayableSdkPhp\Payabl;
use PHPUnit\Framework\TestCase;


class PaymentResourceTest extends TestCase
{
    private $payabl;
    
    protected function setUp(): void
    {
        $this->payabl = new Payabl();

        parent::setUp();
    }


    public function testPaymentAuthoriseSuccess()
    {
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

        ];;
        $response = $this->payabl->payment()->payNow($paymentParams);

        $this->assertInstanceOf(PaymentResults::class, $response);
    }

}
