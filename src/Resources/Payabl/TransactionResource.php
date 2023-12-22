<?php

namespace PayablSdkPhp\Resources\Payabl;

use PayablSdkPhp\DTO\Requests\PaymentRequest;
use PayablSdkPhp\DTO\Requests\TransactionRequest;

use PayablSdkPhp\DTO\Responses\RefundResults;
use PayablSdkPhp\DTO\Responses\Transaction;
use PayablSdkPhp\Resources\AbstractPayablResource;

class TransactionResource extends AbstractPayablResource
{
    public  Transaction $transaction ;

    public function __construct(Transaction $transaction)
    {
        parent::__construct(); // to init adapter
        $this->transaction = $transaction;
    }


    public function refund(array $params): Transaction
    {

        $params['transactionid']  = (string) $this->transaction->transactionid;
        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_refund';

        return $this->adapter->handle('post', $this->getApiRoot().$url, $params, Transaction::class);
    }


    public function capture(): Transaction
    {
        $params  = $this->getArrayFromObject($this->transaction);
        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_capture';

        return $this->adapter->handle('post', $this->getApiRoot().$url, $params, Transaction::class);
    }

    public function cancel(): Transaction
    {
        $params  = $this->getArrayFromObject($this->transaction);
        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_reversal';

        return $this->adapter->handle('post', $this->getApiRoot().$url, $params, Transaction::class);
    }

    public function ctf(array $params): Transaction
    {

        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_cft';

        return $this->adapter->handle('post', $this->getApiRoot().$url, $params, Transaction::class);
    }

}