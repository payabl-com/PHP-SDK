<?php

namespace Payable\SdkPhp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Payable\SdkPhp\Exceptions\PayablException;

class Payabl{

    private ?PayablResponse $payment = null ;

    public function payment(): PayablResponse {

        if (is_null($this->payment)){
            $this->payment = new PayablResponse();
        }
        return $this->payment;
    }

    // другие методы будут здесь


    public function __call(string $name, array $params): void
    {
        throw new PayablException(
            [
                'message' => 'The specified resource (tickets) does not exist',
                'code'    => 404,
                'reason'  => 'Resource not found',
            ]
        );
    }
}


