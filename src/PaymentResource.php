<?php

namespace Payable\SdkPhp;

class PaymentResource extends AbstractResource
{
    public function payNow(array $params): PaymentResults
    {
        $this->validateParams(PaymentRequest::class, $params);
        $url = 'auth..';

        return $this->adapter->handle('POST', $url, PaymentResults::class );
    }

    public function payLater (array $params): PaymentResults {

    }

}