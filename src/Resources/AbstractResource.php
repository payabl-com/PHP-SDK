<?php

namespace PayableSdkPhp\Resources;


use PayableSdkPhp\Exceptions\PayablException;
use PayableSdkPhp\PayablAdapter;


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
}