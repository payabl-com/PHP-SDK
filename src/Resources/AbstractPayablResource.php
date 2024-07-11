<?php

namespace PayablSdkPhp\Resources;

abstract class AbstractPayablResource  extends AbstractResource
{


    const PAYABL_API_BASE_URL_SANDBOX = 'https://sandbox.payabl.com';
    const PAYABL_API_BASE_URL_LIVE = 'https://payabl.com';
    const PAYABL_REST_BACKOFFICE_API = '/pay/backoffice';
    const PAYABL_REST_PAYMENT_API = '/pay/payment';

    public function getApiRootBackoffice(): string
    {
        $apiRoot =  self::PAYABL_API_BASE_URL_SANDBOX;

        $apiRoot .= self::PAYABL_REST_BACKOFFICE_API;

        return $apiRoot;
    }

    public function getApiRootPayment(): string
    {
        $apiRoot = self::PAYABL_API_BASE_URL_SANDBOX;

        $apiRoot .= self::PAYABL_REST_PAYMENT_API;

        return $apiRoot;
    }
}