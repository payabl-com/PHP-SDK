<?php

namespace PayableSdkPhp\DTO\Requests;

use PayableSdkPhp\DataTransferObject;

class PaymentRequest extends  DataTransferObject
{
    public string $cardHolder;
    public string $lastname;
    public float $amount;
}