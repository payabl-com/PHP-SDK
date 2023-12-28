<?php

namespace PayablSdkPhp\Resources\Payabl;

use PayablSdkPhp\DTO\Requests\ManagerRequest;
use PayablSdkPhp\DTO\Requests\PaymentRequest;
use PayablSdkPhp\DTO\Responses\ManagerResponse;
use PayablSdkPhp\DTO\Responses\TransactionResponse;
use PayablSdkPhp\DTO\Transaction;
use PayablSdkPhp\Exceptions\PayablException;
use PayablSdkPhp\Resources\AbstractPayablResource;

class ManagerResource extends AbstractPayablResource
{

    /**
     * @param array $params
     * @return Transaction[] | null
     * @throws PayablException
     */
    public function getTransactions(array $params): ?array
    {

        $this->validateParams(ManagerRequest::class, $params);
        $url = '/tx_diagnose';
        $transactions=[];

        $transactionResponse =  $this->adapter->handle('post', $this->getApiRootBackoffice().$url, $params, ManagerResponse::class);

        foreach($transactionResponse->getResponseArray() as $value){
            $transaction = new Transaction();
            $transaction->fullFillTransactionFromManagerResponseArray($value, $params);
            $transactions[] = $transaction;
        }
        return $transactions;

    }



}