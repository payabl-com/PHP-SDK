<?php

namespace PayablSdkPhp\DTO;

use DateTime;
use PayablSdkPhp\DTO\Responses\ManagerResponse;
use PayablSdkPhp\DTO\Responses\TransactionResponse;

class Transaction
{
    public float $amount;
    public string $currency;
    public ?\DateTime $issue_date = null;
    public ?\DateTime $booking_date = null;
    public ?\DateTime $transaction_date = null;
    public ?string $order_id;
    public ?int $id;
    public ?string $type;

    // from transactionResponse

    public ?int $status = null;
    public ? string $errormessage = null;
    public ? string $errmsg = null;
    public ?float $price = null;
    public ?int $payment_method =  null;
    public ?int $user_id = null;
    public ?string $url_3ds = null;
    public ?string $token_id = null;


    public function fullFillTransactionFromTransactionResponse(TransactionResponse $transactionResponse)
    {
        $this->id = $transactionResponse->transactionid;
        $this->order_id = $transactionResponse->orderid;
        $this->amount = $transactionResponse->amount;
        $this->currency = $transactionResponse->currency;
        $this->errmsg = $transactionResponse->errmsg;
        $this->errormessage = $transactionResponse->errormessage;
        $this->price = $transactionResponse->price;
        $this->payment_method = $transactionResponse->payment_method;
        $this->user_id = $transactionResponse->user_id;
        $this->url_3ds = $transactionResponse->url_3ds;
        $this->token_id = $transactionResponse->token_id;

    }

    public function fullFillTransactionFromManagerResponseArray(array $managerResponseArray, array $params)
    {

        $this->id = (int)$managerResponseArray['transaction_id'];
        $this->amount = (float)$managerResponseArray['amount'];
        $this->currency = (string)$managerResponseArray['currency'];
        $this->order_id = (string)$managerResponseArray['order_id'];
        $this->type = (string)$params['type'];

        if (isset($managerResponseArray['issue_date']))
            $this->issue_date = new DateTime($managerResponseArray['issue_date']);
        if (isset($managerResponseArray['booking_date']))
            $this->booking_date = new DateTime($managerResponseArray['booking_date']);
        if (isset($managerResponseArray['transaction_date']))
            $this->transaction_date = new DateTime($managerResponseArray['transaction_date']);
    }
}