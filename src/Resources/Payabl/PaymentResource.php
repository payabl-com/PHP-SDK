<?php

namespace PayablSdkPhp\Resources\Payabl;

use PayablSdkPhp\DTO\Requests\PaymentRequest;
use PayablSdkPhp\DTO\Responses\Transaction;
use PayablSdkPhp\Resources\AbstractPayablResource;

class PaymentResource extends AbstractPayablResource
{

    public function payNow(array $params): Transaction
    {

        $this->validateParams(PaymentRequest::class, $params);
        $url = '/payment_authorize';

        return $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, Transaction::class);
    }

    public function sendCFT(array $params): Transaction
    {
        // todo: check Backend for CFT from scratch
        $this->validateParams(PaymentRequest::class, $params);
        $url = '/payment_cft';

        return $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, Transaction::class);
    }


    public function initRecurrent(array $params): Transaction
    {

        $this->validateParams(PaymentRequest::class, $params);
        $url = '/init';
        // for this method middle uri is diff.
        return $this->adapter->handle('post',  $this->getApiRootPayment().$url, $params, Transaction::class);
    }



}