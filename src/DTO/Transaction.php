<?php

namespace PayablSdkPhp\DTO;

use DateTime;
use PayablSdkPhp\DTO\Responses\ManagerResponse;
use PayablSdkPhp\DTO\Responses\TransactionResponse;

class Transaction
{
    public ?float $amount = null;
    public ?string $currency = null;
    public ?\DateTime $issueDate = null;
    public ?\DateTime $bookingDate = null;
    public ?\DateTime $transactionDate = null;
    public ?string $orderId;
    public ?int $id;
    public ?string $type;

    // from transactionResponse

    public ?int $status = null;
    public ? string $errorMessage = null;
    public ? string $errMsg = null;
    public ? int $errorCode = null;
    public ?float $price = null;
    public ?int $paymentMethod =  null;
    public ?int $userId = null;
    public ?string $url3ds = null;
    public ?string $tokenId = null;

    public ?string $sessionId = null;
    public ?string $startUrl = null;


    /**
     * @param TransactionResponse $transactionResponse
     * @return $this
     */
    public function fullFillTransactionFromTransactionResponse(TransactionResponse $transactionResponse):Transaction
    {
        $this->id = $transactionResponse->transactionId;
        $this->orderId = $transactionResponse->orderid;
        $this->amount = $transactionResponse->amount;
        $this->currency = $transactionResponse->currency;
        $this->errMsg = $transactionResponse->errMsg;
        $this->errorMessage = $transactionResponse->errorMessage;
        $this->price = $transactionResponse->price;
        $this->paymentMethod = $transactionResponse->paymentMethod;
        $this->userId = $transactionResponse->userId;
        $this->url3ds = $transactionResponse->url3ds;
        $this->tokenId = $transactionResponse->tokenId;
        return $this;
    }

    /**
     * @param array $managerResponseArray
     * @param array $params
     * @return $this
     * @throws \Exception
     */
    public function fullFillTransactionFromManagerResponseArray(array $managerResponseArray, array $params):Transaction
    {

        $this->id = (int)$managerResponseArray['transaction_id'];
        $this->amount = (float)$managerResponseArray['amount'];
        $this->currency = (string)$managerResponseArray['currency'];
        $this->orderId = (string)$managerResponseArray['order_id'];
        $this->type = (string)$params['type'];

        if (isset($managerResponseArray['issue_date']))
            $this->issueDate = new DateTime($managerResponseArray['issue_date']);
        if (isset($managerResponseArray['booking_date']))
            $this->bookingDate = new DateTime($managerResponseArray['booking_date']);
        if (isset($managerResponseArray['transaction_date']))
            $this->transactionDate = new DateTime($managerResponseArray['transaction_date']);
        return $this;
    }

    /**
     * @param TransactionResponse $transactionResponse
     * @return $this
     */
    public function fullFillTransactionBySession(TransactionResponse $transactionResponse):Transaction
    {
        $this->id = $transactionResponse->transactionId;
        $this->orderId = $transactionResponse->orderid;
        $this->sessionId  = $transactionResponse->sessionId;
        $this->errorCode = $transactionResponse->errorCode;
        return $this;
    }

    /**
     * @param TransactionResponse $transactionResponse
     * @return $this
     */
    public function fullFillTransactionByPaymentPage(TransactionResponse $transactionResponse):Transaction
    {
        $this->id = $transactionResponse->transactionId;
        $this->sessionId  = $transactionResponse->sessionId;
        $this->errorCode = $transactionResponse->errorCode;
        $this->errorMessage = $transactionResponse->errorMessage;
        $this->userId = $transactionResponse->userId;
        $this->startUrl = $transactionResponse->startUrl;
        return $this;
    }

}