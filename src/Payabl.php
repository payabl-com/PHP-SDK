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


    private ?PaymentResource $paymentResource = null;
    private ?TransactionResource $transactionResource = null;
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

    /**
     * @return PaymentResource
     */
    public function getPaymentResource(): PaymentResource
    {
        if (is_null($this->paymentResource)) {
            $this->paymentResource = new PaymentResource($this->getAllParams());
        }
        return $this->paymentResource;
    }

    /**
     * @param Transaction $transaction
     * @return TransactionResource
     */
    public function getTransactionResource(Transaction $transaction): TransactionResource
    {
        if (is_null($this->transactionResource)) {
            $this->transactionResource = new TransactionResource($transaction);
            $this->transactionResource->setCardDetails($this->cardDetails);
        }
        return $this->transactionResource;
    }


    public function getManagerResource(): ManagerResource
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
            'payment_method' => $params['payment_method'] ?? 1,
        ];

        return $this;
    }

    public function setCustomerData(array $params): self
    {
        $this->customerData = [
            "customerip" => $params['customer_ip']??"",
            "email" => $params['email'],
            "firstname" => $params['firstname'],
            "lastname" => $params['lastname'],
            "language" => $params['language'],
            "salutation" => $params['salutation'] ?? "",
            "title" => $params['title'] ?? "",
            "gender" => $params['gender'] ?? "",
            "birthday" => $params['birthday'] ?? "",
            "phone" => $params['phone'] ?? "",
            "fax" => $params['fax'] ?? "",
            "mobile" => $params['mobile'] ?? "",
            "custom1" => $params['custom1'] ?? "",
            "custom2" => $params['custom2'] ?? "",
            "custom3" => $params['custom3'] ?? "",
        ];
        return $this;
    }

    public function setShippingData(array $params):self
    {
        $this->customerAddress = [
            "shipping_state" => $params['shipping_state'] ?? "",
            "shipping_city" => $params['shipping_city'] ?? "",
            "shipping_address_line_1" => $params['shipping_address_line_1'] ?? "",
            "shipping_address_line_2" => $params['shipping_address_line_2'] ?? "",
            "shipping_postal_code" => $params['shipping_postal_code'] ?? "",
            "shipping_first_name" => $params['shipping_first_name'] ?? "",
            "shipping_last_name" => $params['shipping_last_name'] ?? ""
        ];
        return $this;
    }

    public function setBillingData(array $params):self
    {
        $this->customerAddress = [
            "billing_country_code" => $params['billing_country_code'] ?? "",
            "billing_state" => $params['billing_state'] ?? "",
            "billing_city" => $params['billing_city'] ?? "",
            "billing_address_line_1" => $params['billing_address_line_1'] ?? "",
            "billing_address_line_2" => $params['billing_address_line_2'] ?? "",
            "billing_postal_code" => $params['billing_postal_code'] ?? "",
            "billing_first_name" => $params['billing_first_name'] ?? "",
            "billing_last_name" => $params['billing_last_name'] ?? ""
        ];
        return $this;
    }

    public function setCustomerAddress(array $params): self
    {
        $this->customerAddress = [
            "company" => $params['company'],
            "country" => $params['country'] ?? "",
            "city" => $params['city'] ?? "",
            "state" => $params['state'] ?? "",
            "street" => $params['street'],
            "house" => $params['house'] ?? "",
            "zip" => $params['zip'],
            "postbox" => $params['postbox'] ?? "",
        ];
        return $this;
    }

    public function setCustomerOrder(array $params): self
    {
        $this->customerOrder = [
            "amount" => $params['amount'],
            "orderid" => $params['order_id']??"",
            "currency" => $params['currency'] ?? "EUR",
            "notification_url" => $params['notification_url'] ?? "",
            "payment_method" => $params['payment_method'] ?? 1,
            "url_return" => $params['url_return'] ?? "",
        ];
        return $this;
    }


    public function setMerchantData(array $params): self
    {
        $this->merchantData = [
            "shop_url" => $params['shop_url'] ?? null,
            "notification_url" => $params['notification_url'] ?? null,
            "language" => $params['language'] ?? "en",
            "external_id" => $params['external_id'] ?? "",
        ];
        return $this;
    }


    /**
     * @return array
     */
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


