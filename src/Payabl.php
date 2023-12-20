<?php

namespace PayableSdkPhp;


use PayableSdkPhp\Exceptions\PayablException;
use Dotenv\Dotenv;
use PayableSdkPhp\Resources\Payabl\PaymentResource;

class Payabl{

    private ?PaymentResource $payment = null ;

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


