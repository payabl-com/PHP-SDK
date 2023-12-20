<?php

namespace Payable\SdkPhp\Resources\Payabl;

use Payable\SdkPhp\DTO\Responses\PaymentResults;
use Payable\SdkPhp\Resources\AbstractPayablResource;

class PaymentResource extends AbstractPayablResource
{

    public function payNow(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);
        $url = 'search/page' . "?" . http_build_query($params);

        return $this->adapter->handle('get', $url, PaymentResults::class);
    }


    public function payLater(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);

        $url = 'search/title' . "?" . http_build_query($params);

        return $this->adapter->handle('get', $url, PaymentResults::class);
    }


    public function refund(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);

        $url = 'search/title' . "?" . http_build_query($params);

        return $this->adapter->handle('get', $url, PaymentResults::class);
    }

    public function capture(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);

        $url = 'search/title' . "?" . http_build_query($params);

        return $this->adapter->handle('get', $url, PaymentResults::class);
    }

    public function cancel(array $params): PaymentResults
    {
        $this->validateParams(PaymentResults::class, $params);

        $url = 'search/title' . "?" . http_build_query($params);

        return $this->adapter->handle('get', $url, PaymentResults::class);
    }


}