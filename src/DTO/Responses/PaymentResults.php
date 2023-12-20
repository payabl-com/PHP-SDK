<?php

namespace Payable\SdkPhp\DTO\Responses;


use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

class PaymentResults extends  DataTransferObject
{
    #[CastWith(ArrayCaster::class, itemType: PaymentResultObject::class)]
    public array  $pages;
}