<?php

namespace PayableSdkPhp\DTO\Requests;


class PaymentRequest extends  DataTransferObject
{
    public string $cardHolder;
    public string $lastname;
    public float $amount;
}