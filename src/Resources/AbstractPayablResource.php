<?php

namespace PayablSdkPhp\Resources;

abstract class AbstractPayablResource  extends AbstractResource
{

    const PAYABL_API_BASE_URL_LIVE = 'https://payabl.com';
    const PAYABL_API_BASE_URL_SANDBOX = 'https://sandbox.payabl.com';

    const PAYABL_REST_BACKOFFICE_API_LIVE = '/pay/backoffice';
    const PAYABL_REST_BACKOFFICE_API_SANDBOX = '/pay/backoffice';

    const PAYABL_REST_PAYMENT_API_LIVE = '/pay/payment';
    const PAYABL_REST_PAYMENT_API_SANDBOX = '/pay/payment';

    public function getApiRootBackoffice($env): string
    {
       switch ($env){
           case "live":
               $apiRoot =  self::PAYABL_API_BASE_URL_LIVE;
               $apiRoot .= self::PAYABL_REST_BACKOFFICE_API_LIVE;
               break;
           case "sandbox":
           default:
               $apiRoot =  self::PAYABL_API_BASE_URL_SANDBOX;
               $apiRoot .= self::PAYABL_REST_BACKOFFICE_API_SANDBOX;
               break;
       }

        return $apiRoot;
    }

    public function getApiRootPayment($env): string
    {
        switch ($env){
            case "live":
                $apiRoot =  self::PAYABL_API_BASE_URL_LIVE;
                $apiRoot .= self::PAYABL_REST_PAYMENT_API_LIVE;
                break;
            case "sandbox":
            default:
                $apiRoot =  self::PAYABL_API_BASE_URL_SANDBOX;
                $apiRoot .= self::PAYABL_REST_PAYMENT_API_SANDBOX;
                break;
        }
        return $apiRoot;
    }
}