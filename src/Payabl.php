<?php

namespace PayableSdkPhp;


use PayableSdkPhp\Exceptions\PayablException;
use Dotenv\Dotenv;
use PayableSdkPhp\Resources\Payabl\PaymentResource;
use PayableSdkPhp\Resources\Payabl\RefundResource;

class Payabl{

    private ?PaymentResource $payment = null ;
    private ?RefundResource $refund = null ;

    public function __construct(){
        $dotenv = Dotenv::createImmutable(__DIR__ . "../..");
        $dotenv->load();
    }

    public function payment(): PaymentResource {
        if (is_null($this->payment)){
            $this->payment = new PaymentResource();
        }
        return $this->payment;
    }

    public function refund():RefundResource
    {
        if (is_null($this->refund)){
            $this->refund = new RefundResource();
        }
        return $this->refund;
    }
    
    // todo: add more resources


    public function __call(string $name, array $params): void
    {
        throw new PayablException(
            [
                'message' => 'The specified resource (tickets) does not exist',
                'code'    => 404,
                'reason'  => 'Resource not found',
            ]
        );
    }
}


