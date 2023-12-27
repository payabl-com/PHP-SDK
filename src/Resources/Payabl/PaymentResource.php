<?php

namespace PayablSdkPhp\Resources\Payabl;

use PayablSdkPhp\DTO\Requests\PaymentRequest;
use PayablSdkPhp\DTO\Responses\TransactionResponse;
use PayablSdkPhp\Resources\AbstractPayablResource;

class PaymentResource extends AbstractPayablResource
{

    private array  $params  ;

    public function __construct(array $params)
    {
        $this->params = $params;
        parent::__construct();
    }

    public function payNow( ): TransactionResponse
    {
        dump("делаем payNow");
        $this->validateParams(PaymentRequest::class, $this->params);
        $url = '/payment_authorize';
        dump("ВАЛИД");
        return $this->adapter->handle('post', $this->getApiRootBackoffice().$url,  $this->params, TransactionResponse::class);
    }

    public function sendCFT(): TransactionResponse
    {
        // todo: check Backend for CFT from scratch
        $this->validateParams(PaymentRequest::class,  $this->params);
        $url = '/payment_cft';

        return $this->adapter->handle('post', $this->getApiRootBackoffice().$url,  $this->params, TransactionResponse::class);
    }


    public function initRecurrent(): TransactionResponse
    {

        $this->validateParams(PaymentRequest::class,  $this->params);
        $url = '/init';
        // for this method middle uri is diff.
        return $this->adapter->handle('post',  $this->getApiRootPayment().$url,  $this->params, TransactionResponse::class);
    }



}