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


    public function payLater(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);

        $url = 'search/title' . "?" . http_build_query($params);

        return $this->adapter->handle('post', $url, $params,PaymentResults::class);
    }


    public function refund(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);

        $url = 'search/title' . "?" . http_build_query($params);

        return $this->adapter->handle('post', $url,$params, PaymentResults::class);
    }

    public function capture(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);

        $url = 'search/title' . "?" . http_build_query($params);

        return $this->adapter->handle('post', $url, $params,PaymentResults::class);
    }

    public function cancel(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);

        $url = 'search/title' . "?" . http_build_query($params);

        return $this->adapter->handle('post', $url, $params,PaymentResults::class);
    }


}