<?php

namespace PayableSdkPhp\DTO\Responses;



class RefundResults
{
    public int $transactionid = 0;
    public int $transid = 0;
    public int $status = 0;
    public string $errormessage = "";
    public string $errmsg = "";
    public float $amount = 0.0;
    public float $price = 0.0;
    public string $currency = "";
    public int $orderid = 0;


    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $type = gettype($this->$key);
                settype($value, $type);
                $this->$key = $value;
            }
        }
    }
}