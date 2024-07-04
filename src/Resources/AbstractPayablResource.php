<?php

namespace PayablSdkPhp\Resources;

abstract class AbstractPayablResource  extends AbstractResource
{


    const PAYABL_REST_BACKOFFICE_API = '/pay/backoffice';
    const PAYABL_REST_PAYMENT_API = '/pay/payment';

    public function getApiRootBackoffice(): string
    {
        $apiRoot =  $_ENV['PAYABL_BASE_URL'] ;

        $apiRoot .= self::PAYABL_REST_BACKOFFICE_API;

        return $apiRoot;
    }

    public function getApiRootPayment(): string
    {
        $apiRoot =  $_ENV['PAYABL_BASE_URL'] ;

        $apiRoot .= self::PAYABL_REST_PAYMENT_API;

        return $apiRoot;
    }
}