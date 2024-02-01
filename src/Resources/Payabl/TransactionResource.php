<?php

namespace PayablSdkPhp\Resources\Payabl;


use PayablSdkPhp\DTO\Requests\TransactionRequest;


use PayablSdkPhp\DTO\Responses\TransactionResponse;
use PayablSdkPhp\DTO\Transaction;
use PayablSdkPhp\Exceptions\PayablException;
use PayablSdkPhp\Resources\AbstractPayablResource;

class TransactionResource extends AbstractPayablResource
{
    public  Transaction $transaction ;

    private string $ccn ;
    private string $exp_month ;
    private string $exp_year ;
    private string $cardholder_name ;
    private string $payment_method ;

    public function __construct(Transaction $transaction)
    {
        parent::__construct(); // to init adapter
        $this->transaction = $transaction;
    }

    /**
     * @param array $cardDetails
     * @return $this
     */
    public function setCardDetails(array $cardDetails):self
    {
        $this->ccn =  (string) $cardDetails['ccn'];
        $this->exp_month =  (string) $cardDetails['exp_month'];
        $this->exp_year =  (string) $cardDetails['exp_year'];
        $this->cardholder_name =  (string) $cardDetails['cardholder_name'];
        $this->payment_method =  (string) $cardDetails['payment_method'];
        return $this;
    }

    public function refund(array $params): Transaction
    {

        $params['transactionid']  = (string) $this->transaction->id;

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
        $params['transactionid']  = (string) $this->transaction->id;

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
        $params['transactionid']  = (string) $this->transaction->id;
        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_reversal';

        $transactionResponse = $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, TransactionResponse::class);
        $transaction = new Transaction();
        $transaction->fullFillTransactionFromTransactionResponse($transactionResponse);
        return $transaction;

    }

    /**
     * @param array $params
     * @return Transaction
     * @throws PayablException
     */
    public function sendCFTByTransaction(array $params): Transaction
    {
//        $paramsFormObject  = $this->getArrayFromObject($this->transaction);
        $params['transactionid']  =  (string) $this->transaction->id;
        $params['ccn']= $this->ccn;
        $params['exp_month']=$this->exp_month;
        $params['exp_year']=$this->exp_year;
        $params['cardholder_name']=$this->cardholder_name;
        $params['payment_method']=$this->payment_method;

        // todo: check Backend for CFT by Transaction
        // todo: change return type..


        $this->validateParams(TransactionRequest::class, $params);
        $url = '/payment_cft';

        $transactionResponse = $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, TransactionResponse::class);
        $transaction = new Transaction();
        $transaction->fullFillTransactionFromTransactionResponse($transactionResponse);
        return $transaction;

    }

}