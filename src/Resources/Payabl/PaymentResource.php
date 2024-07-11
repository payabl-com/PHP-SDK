<?php

namespace PayablSdkPhp\Resources\Payabl;

use PayablSdkPhp\DTO\Requests\PaymentRequest;
use PayablSdkPhp\DTO\Responses\TransactionResponse;
use PayablSdkPhp\DTO\Transaction;
use PayablSdkPhp\Resources\AbstractPayablResource;

class PaymentResource extends AbstractPayablResource
{

    private array  $params  ;

    public function __construct(array $params)
    {
        $this->params = $params;
        parent::__construct();
    }

    public function payNow(): Transaction
    {

        $this->validateParams(PaymentRequest::class, $this->params);
        $url = '/payment_authorize';

        $transactionResponse =  $this->adapter->handle('post', $this->getApiRootBackoffice().$url,  $this->params, TransactionResponse::class);

        $transaction = new Transaction();
        $transaction->fullFillTransactionFromTransactionResponse($transactionResponse);

        return $transaction;
    }

    public function sendCFT(): Transaction
    {
        // todo: check Backend for CFT from scratch
        $this->validateParams(PaymentRequest::class,  $this->params);
        $url = '/payment_cft';

        $transactionResponse =  $this->adapter->handle('post', $this->getApiRootBackoffice().$url,  $this->params, TransactionResponse::class);
        $transaction = new Transaction();
        $transaction->fullFillTransactionFromTransactionResponse($transactionResponse);
        return $transaction;
    }

    public function initRecurrent(): Transaction
    {
        $this->validateParams(PaymentRequest::class,  $this->params);
        $url = '/init';
        // for this method middle uri is diff.
        $transactionResponse = $this->adapter->handle('post',  $this->getApiRootPayment().$url,  $this->params, TransactionResponse::class);
        $transaction = new Transaction();
        $transaction->fullFillTransactionFromTransactionResponse($transactionResponse);
        return $transaction;
    }


    public function getPaymentWidgetSession(): Transaction
    {

        $this->validateParams(PaymentRequest::class,  $this->params);
        $url = '/get_payment_widget_session';
        // for this method middle uri is diff.
        $transactionResponse = $this->adapter->handle('post',  $this->getApiRootPayment().$url,  $this->params, TransactionResponse::class);

        $transaction = new Transaction();
        $transaction->fullFillTransactionBySession( $transactionResponse);
        return $transaction;
    }

    public function initialHostedPaymentPage():Transaction
    {
        $this->validateParams(PaymentRequest::class,  $this->params);
        $url = '/init';
        $urlRequest = $this->getApiRootPayment().$url;
        $transactionResponse = $this->adapter->handle('post',  $urlRequest,  $this->params, TransactionResponse::class);
        $transaction = new Transaction();
        $transaction->fullFillTransactionByPaymentPage( $transactionResponse);
        return $transaction;

    }


}