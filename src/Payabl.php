<?php

namespace PayablSdkPhp;


use PayablSdkPhp\DTO\Responses\Transaction;
use PayablSdkPhp\Exceptions\PayablException;
use Dotenv\Dotenv;
use PayablSdkPhp\Resources\Payabl\PaymentResource;
use PayablSdkPhp\Resources\Payabl\TransactionResource;

class Payabl{

    private ?PaymentResource $payment = null ;
    private ?TransactionResource $transaction = null ;

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

    public function transaction(Transaction $transaction):TransactionResource
    {
        if (is_null($this->transaction)){
            $this->transaction = new TransactionResource($transaction);

        }
        return $this->transaction;
    }
    
    // todo: add more resources


    public function __call(string $name, array $params): void
    {
        throw new PayablException(
            [
                'message' => 'The specified resource does not exist',
                'code'    => 404,
                'reason'  => 'Resource not found',
            ]
        );
    }
}


