<?php

namespace PayablSdkPhp\DTO\Responses;


use PayablSdkPhp\DTO\Transaction;

class TransactionResponse
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
    public int $payment_method = 0;
    public int $user_id = 0;
    public ?string $url_3ds = null;
    public ?string $token_id = null;

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