<?php

namespace Payabl;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Payabl{

    private ?PaymentResource $payment = null ;

    public function payment(): PaymentResource {

        if (is_null($this->payment)){
            $this->payment = new PaymentResource();
        }
        return $this->payment;
    }
}


