<?php

namespace PayableSdkPhp\Resources;

abstract class AbstractPayablResource  extends AbstractResource
{
    const PAYABL_REST_API = '/powercash21-3-2/backoffice';

    public function getApiRoot(): string
    {
        $apiRoot =  $_ENV['PAYABL_BASE_URL'] ;

        $apiRoot .= self::PAYABL_REST_API;

        return $apiRoot;
    }
}