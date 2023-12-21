<?php

namespace PayableSdkPhp\Resources\Payabl;

use PayableSdkPhp\DTO\Responses\PaymentResults;
use PayableSdkPhp\Resources\AbstractPayablResource;

class PaymentResource extends AbstractPayablResource
{

    public function payNow(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);
        $url = '/payment_authorize';

        return $this->adapter->handle('post', $this->getApiRoot().$url, $params, PaymentResults::class);
    }
 

}