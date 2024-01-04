<?php

namespace PayablSdkPhp\DTO\Responses;


use PayablSdkPhp\DTO\Transaction;

class TransactionResponse
{
    public int $transactionid = 0;

    public int $status = 0;
    public string $errormessage = "";
    public string $errmsg = "";
    public int $errorcode = 0;
    public float $amount = 0.0;
    public float $price = 0.0;
    public string $currency = "";
    public int $orderid = 0;
    public int $payment_method = 0;
    public int $user_id = 0;
    public ?string $url_3ds = null;
    public ?string $token_id = null;
    public ?string $session_id = null;

    public function __construct(array $data)
    {
        $this->transactionid = $data['transactionid'] ?? 0;
        $this->status = $data['status'] ?? 0;
        $this->errormessage = $data['errormessage'] ?? "";
        $this->errmsg = $data['errmsg'] ?? "";
        $this->errorcode = $data['errorcode'] ?? 0;
        $this->amount = $data['amount'] ?? 0.0;
        $this->price = $data['price'] ?? 0;
        $this->currency = $data['currency'] ?? "";
        $this->orderid = $data['orderid'] ?? 0;
        $this->payment_method = $data['payment_method'] ?? 0;
        $this->user_id = $data['user_id'] ?? 0;
        $this->url_3ds = $data['url_3ds'] ?? null;
        $this->token_id = $data['token_id'] ?? null;
        $this->session_id = $data['session_id'] ?? null;
    }

}