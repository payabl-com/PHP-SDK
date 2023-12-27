<?php

namespace PayablSdkPhp;


use PayablSdkPhp\DTO\Responses\TransactionResponse;
use PayablSdkPhp\Exceptions\PayablException;
use Dotenv\Dotenv;
use PayablSdkPhp\Resources\Payabl\ManagerResource;
use PayablSdkPhp\Resources\Payabl\PaymentResource;
use PayablSdkPhp\Resources\Payabl\TransactionResource;

class Payabl{

    const TRANSACTION_TYPE_CAPTURE = "capture";
    const TRANSACTION_TYPE_CHARGEBACK = "chb";
    const TRANSACTION_TYPE_REFUND = "refund";
    const TRANSACTION_TYPE_RETRIEVAL_REQUEST = "retrieval_request";
    const TRANSACTION_TYPE_CFT = "cft";

    private ?PaymentResource $payment = null ;
    private ?TransactionResource $transaction = null ;
    private ?ManagerResource $manager = null ;

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

    public function transaction(TransactionResponse $transaction):TransactionResource
    {
        if (is_null($this->transaction)){
            $this->transaction = new TransactionResource($transaction);

        }
        return $this->transaction;
    }


    public function manager(): ManagerResource {
        if (is_null($this->manager)){
            $this->manager = new ManagerResource();
        }
        return $this->manager;
    }


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


