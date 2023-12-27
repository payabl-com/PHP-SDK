<?php

namespace PayablSdkPhp\Resources\Payabl;

use PayablSdkPhp\DTO\Requests\PaymentRequest;
use PayablSdkPhp\DTO\Requests\TransactionRequest;

use PayablSdkPhp\DTO\Responses\PaymentResults;
use PayablSdkPhp\DTO\Responses\TransactionResponse;
use PayablSdkPhp\DTO\Transaction;
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

        $transactionResponse = $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, TransactionResponse::class);
        $transaction = new Transaction();
        $transaction->fullFillTransactionFromTransactionResponse($transactionResponse);
        return $transaction;

    }


    public function capture(): Transaction
    {
        $params  = $this->getArrayFromObject($this->transaction);
        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_capture';

        $transactionResponse = $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, TransactionResponse::class);
        $transaction = new Transaction();
        $transaction->fullFillTransactionFromTransactionResponse($transactionResponse);
        return $transaction;
    }

    public function cancel(): Transaction
    {
        $params  = $this->getArrayFromObject($this->transaction);
        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_reversal';

        $transactionResponse = $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, TransactionResponse::class);
        $transaction = new Transaction();
        $transaction->fullFillTransactionFromTransactionResponse($transactionResponse);
        return $transaction;

    }

    public function sendCFTByTransaction(array $params): TransactionResponse
    {
//        $paramsFormObject  = $this->getArrayFromObject($this->transaction);
        $paramsFormObject['transactionid']  =  $this->transaction->transactionid;
        $paramsFormObject['amount'] = $params['amount'];
        $paramsFormObject['currency'] = $params['currency'];
        $paramsFormObject['payment_method'] =1;
        // todo: check Backend for CFT by Transaction
        // todo: change return type..


        $this->validateParams(TransactionRequest::class, $paramsFormObject);
        $url = '/payment_cft';

        return $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $paramsFormObject, TransactionResponse::class);
    }

}