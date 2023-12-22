<?php

namespace PayablSdkPhp\Resources;


use PayablSdkPhp\Exceptions\PayablException;
use PayablSdkPhp\PayablAdapter;


abstract class AbstractResource
{
    protected PayablAdapter $adapter;

    public function __construct(){
        $this->adapter = new PayablAdapter($this);
    }

    protected function validateParams(string $dtoClass, array $params):void {
        try {
            new $dtoClass($params);
        } catch (\TypeError $e){
            $error = [
                'reason'=>"Type error",
                'code'=>$e->getCode(),
                'message'=>$e->getMessage()
            ];
            throw new PayablException($error);
        }
    }

    public function getArrayFromObject( $dtoClass):array
    {
        return get_object_vars($dtoClass);
    }
}