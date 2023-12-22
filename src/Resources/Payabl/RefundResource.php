<?php

namespace PayableSdkPhp\Resources\Payabl;

use PayableSdkPhp\DTO\Requests\RefundRequest;
use PayableSdkPhp\DTO\Responses\PaymentResults;
use PayableSdkPhp\DTO\Responses\RefundResults;
use PayableSdkPhp\Resources\AbstractPayablResource;

class RefundResource extends AbstractPayablResource
{

    public function refundNow(array $params): RefundResults
    {
        $this->validateParams(RefundRequest::class, $params);
        $url = '/payment_refund';

        return $this->adapter->handle('post', $this->getApiRoot().$url, $params, RefundResults::class);
    }


}