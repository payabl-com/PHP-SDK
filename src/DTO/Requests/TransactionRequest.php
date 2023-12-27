<?php

namespace PayablSdkPhp\DTO\Requests;


class TransactionRequest
{

    public int $transactionid;
    public float $amount;
    public string $currency;

    public function __construct(array $params)
    {
        $this->amount = $params['amount'];
        $this->transactionid = $params['transactionid'];
        $this->currency = $params['currency'];

        // todo add checks
    }
}