<?php

namespace PayablSdkPhp;


use PayablSdkPhp\DTO\Responses\TransactionResponse;
use PayablSdkPhp\DTO\Transaction;
use PayablSdkPhp\Exceptions\PayablException;
use Dotenv\Dotenv;
use PayablSdkPhp\Resources\Payabl\ManagerResource;
use PayablSdkPhp\Resources\Payabl\PaymentResource;
use PayablSdkPhp\Resources\Payabl\TransactionResource;

class Payabl
{

    const TRANSACTION_TYPE_CAPTURE = "capture";
    const TRANSACTION_TYPE_CHARGEBACK = "chb";
    const TRANSACTION_TYPE_REFUND = "refund";
    const TRANSACTION_TYPE_RETRIEVAL_REQUEST = "retrieval_request";
    const TRANSACTION_TYPE_CFT = "cft";
    const TRANSACTION_TYPE_PENDING = "pending";
    const TRANSACTION_TYPE_FAILED = "failed";
    const TRANSACTION_TYPE_BY_TRANSACTION = "tx";
    const TRANSACTION_TYPE_BY_ORDER_ID = "orderid";


    private ?PaymentResource $payment = null;
    private ?TransactionResource $transaction = null;
    private ?ManagerResource $manager = null;
    private array $cardDetails = [];

    private array $customerOrder = [];
    private array $customerData = [];
    private array $customerAddress = [];
    private array $merchantData = [];

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . "../..");
        $dotenv->load();
    }

    public function payment(): PaymentResource
    {
        if (is_null($this->payment)) {
            $this->payment = new PaymentResource($this->getAllParams());
        }
        return $this->payment;
    }

    public function transaction(Transaction $transaction): TransactionResource
    {
        if (is_null($this->transaction)) {
            $this->transaction = new TransactionResource($transaction);

        }
        return $this->transaction;
    }


    public function manager(): ManagerResource
    {
        if (is_null($this->manager)) {
            $this->manager = new ManagerResource();
        }
        return $this->manager;
    }


    public function setCardDetails(array $params): self
    {
        $this->cardDetails = [
            'cardholder_name' => $params['cardholder_name'],
            'ccn' => $params['ccn'],
            'exp_month' => $params['exp_month'],
            'exp_year' => $params['exp_year'],
            'cvc_code' => $params['cvc_code'],
        ];

        return $this;
    }

    public function setCustomerData(array $params): self
    {
        $this->customerData = [
            "customerip" => $params['customer_ip'],
            "email" => $params['email'],
            "firstname" => $params['firstname'],
            "lastname" => $params['lastname'],
            "language" => $params['language'],
            "salutation" => $params['salutation'] ?? "",
            "title" => $params['title'] ?? "",
            "gender" => $params['gender'] ?? "",
            "birthday" => $params['birthday'] ?? "",
        ];

        return $this;
    }

    public function setCustomerAddress(array $params): self
    {
        $this->customerAddress = [
            "company" => $params['company'],
            "country" => $params['country'],
            "city" => $params['city'],
            "state" => $params['state'],
            "street" => $params['street'],
            "zip" => $params['zip'],
        ];

        return $this;
    }

    public function setCustomerOrder(array $params): self
    {
        $this->customerOrder = [
            "amount" => $params['amount'],
            "orderid" => $params['order_id'],
            "currency" => $params['currency'] ?? "EUR",
            "payment_method" => $params['payment_method'] ?? "1",
            "notification_url" => $params['notification_url'] ?? "",
        ];

        return $this;
    }


    public function setMerchantData(array $params): self
    {
        $this->merchantData = [
            "shop_url" => $params['shop_url'] ?? null,
            "notification_url" => $params['notification_url'] ?? null,
        ];

        return $this;
    }

    public function getAllParams(): array
    {
        return array_merge($this->cardDetails, $this->customerOrder, $this->customerAddress, $this->customerData,  $this->merchantData, );
    }

    public function __call(string $name, array $params): void
    {
        throw new PayablException(
            [
                'message' => 'The specified resource does not exist',
                'code' => 404,
                'reason' => 'Resource not found',
            ]
        );
    }
}


