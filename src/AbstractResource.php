<?php

namespace Payable\SdkPhp;

use Cassandra\Exception\ValidationException;
use Payabl\Payabl;

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
        catch (UnknownProperties $e){
            $error = [
                'reason'=>"Resource validation: Unknown properties",
                'code'=>$e->getCode(),
                'message'=>$e->getMessage()
            ];
            throw new UnknownProperties($error);
        }
        catch (ValidationException $e){
            $error = [
                'reason'=>"Invalid request parameter",
                'code'=>422,
                'message'=>$e->getMessage()
            ];
            throw new ValidationException($error);
        }
    }
}