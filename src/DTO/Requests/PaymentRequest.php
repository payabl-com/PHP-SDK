<?php

namespace PayablSdkPhp\DTO\Requests;


class PaymentRequest
{
    public string $cardholder_name;
    public ?string $firstname = null;
    public ?string $lastname = null;
    public ?string $street = null;
    public ?string $zip = null;
    public ?string $city = null;
    public ?string $state = null;
    public ?string $country = null;
    public ?string $email = null;
    public ?string $customerip = null;
    public ?string $recurring_id = null;
    public ?string  $token_id = null;
    public ?string  $cof = null;
    public ?string $shop_url = null;
    public ?string $notification_url = null;

    public float $amount;
    public string $currency;
    public int $payment_method;


    public function __construct(array $params)
    {


        foreach ($params as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        // todo add checks
    }
}