<?php

namespace PayableSdkPhp\DTO\Requests;


class RefundRequest
{
    public string $cardHolder;
    public string $lastname;
    public int $transactionid;
    public float $amount;
}