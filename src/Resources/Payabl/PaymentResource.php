<?php

namespace PayablSdkPhp\Resources\Payabl;

use PayablSdkPhp\DTO\Requests\PaymentRequest;
use PayablSdkPhp\DTO\Responses\PaymentResults;
use PayablSdkPhp\Resources\AbstractPayablResource;

class PaymentResource extends AbstractPayablResource
{

    public function payNow(array $params): PaymentResults
    {

        $this->validateParams(PaymentRequest::class, $params);
        $url = '/payment_authorize';

        return $this->adapter->handle('post', $this->getApiRoot().$url, $params, PaymentResults::class);
    }


}