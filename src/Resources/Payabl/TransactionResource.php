<?php

namespace PayablSdkPhp\Resources\Payabl;

use PayablSdkPhp\DTO\Requests\PaymentRequest;
use PayablSdkPhp\DTO\Requests\TransactionRequest;

use PayablSdkPhp\DTO\Responses\PaymentResults;
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

        return $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, Transaction::class);
    }


    public function capture(): Transaction
    {
        $params  = $this->getArrayFromObject($this->transaction);
        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_capture';

        return $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, Transaction::class);
    }

    public function cancel(): Transaction
    {
        $params  = $this->getArrayFromObject($this->transaction);
        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_reversal';

        return $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, Transaction::class);
    }

    public function sendCFTByTransaction(array $params): Transaction
    {
//        $paramsFormObject  = $this->getArrayFromObject($this->transaction);
        $paramsFormObject['transactionid']  =  $this->transaction->transactionid;
        $paramsFormObject['amount'] = $params['amount'];
        $paramsFormObject['currency'] = $params['currency'];
        $paramsFormObject['payment_method'] =1;
        // todo: check Backend for CFT by Transaction



        $this->validateParams(TransactionRequest::class, $paramsFormObject);
        $url = '/payment_cft';

        return $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $paramsFormObject, Transaction::class);
    }

}