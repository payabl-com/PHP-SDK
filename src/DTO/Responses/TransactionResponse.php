<?php

namespace PayablSdkPhp\DTO\Responses;


use PayablSdkPhp\DTO\Transaction;

class TransactionResponse
{
    public int $transactionId = 0;

    public int $status = 0;
    public string $errorMessage = "";
    public string $errMsg = "";
    public int $errorCode = 0;
    public float $amount = 0.0;
    public float $price = 0.0;
    public string $currency = "";
    public int $orderid = 0;
    public int $paymentMethod = 0;
    public int $userId = 0;
    public ?string $url3ds = null;
    public ?string $tokenId = null;


    public function __construct(array $data)
    {
        $this->transactionId = (int)$data['transactionid'] ?? 0;
        $this->status = $data['status'] ?? 0;
        $this->errorMessage = $data['errormessage'] ?? "";
        $this->errMsg = $data['errmsg'] ?? "";
        $this->errorCode = $data['errorcode'] ?? 0;
        $this->amount = isset($data['amount']) ? (float)$data['amount'] : 0.0;
        $this->price = (float)$data['price'] ?? 0;
        $this->currency = $data['currency'] ?? "";
        $this->orderid = (int)$data['orderid'] ?? 0;
        if (isset($data['payment_method']))
            $this->paymentMethod = (int)$data['payment_method'] ?? 0;
        if (isset($data['user_id']))
            $this->userId = (int)$data['user_id'] ?? 0;
        $this->url3ds = $data['url_3ds'] ?? null;
        $this->tokenId = $data['token_id'] ?? null;
    }

}