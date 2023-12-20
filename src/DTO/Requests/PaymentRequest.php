<?php

namespace PayableSdkPhp\DTO\Requests;

use PayableSdkPhp\DataTransferObject;

class PaymentRequest extends  DataTransferObject
{
    public string $cardHolder;
    public string $lastname;
    /// .... другие публичные свойства класса
    /// можно добавить проверки
    /// можно добавить дефолтные значения

    public float $amount;
}