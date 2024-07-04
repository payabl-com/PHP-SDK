<?php

namespace PayablSdkPhp\DTO\Requests;


class TransactionRequest
{

    public int $transactionid;
    public float $amount;
    public string $currency;
    private ?string $payment_method;
    private ?string $ccn;
    private ?string $exp_month;
    private ?string $exp_year;
    private ?string $cardholder_name;

    public function __construct(array $params)
    {
        $this->amount = $params['amount'];
        $this->transactionid = $params['transactionid'];
        $this->currency = $params['currency'];
        $this->payment_method = $params['payment_method'];
        $this->ccn = $params['ccn'];
        $this->exp_month = $params['exp_month'];
        $this->exp_year = $params['exp_year'];
        $this->cardholder_name = $params['cardholder_name'];
    }
}