<?php

namespace PayablSdkPhp\Resources\Payabl;

use PayablSdkPhp\DTO\Requests\RefundRequest;
use PayablSdkPhp\DTO\Responses\PaymentResults;
use PayablSdkPhp\DTO\Responses\RefundResults;
use PayablSdkPhp\Resources\AbstractPayablResource;

class RefundResource extends AbstractPayablResource
{

    public function refundNow(array $params): RefundResults
    {
        $this->validateParams(RefundRequest::class, $params);
        $url = '/payment_refund';

        return $this->adapter->handle('post', $this->getApiRoot().$url, $params, RefundResults::class);
    }


}