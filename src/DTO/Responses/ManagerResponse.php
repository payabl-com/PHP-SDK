<?php

namespace PayablSdkPhp\DTO\Responses;


class ManagerResponse
{

    private array $responseArray ;

    public function __construct(array $data)
    {

        $this->responseArray = $this->parseXmlFromArray($data);
    }

    private function parseXmlFromArray(array $array) {
        $xmlKey = key($array);
        $xmlString = $array[$xmlKey];


        $xmlString = trim($xmlString);
        $xmlString = str_replace('"1.0" encoding="ISO-8859-1"?>', '', $xmlString);
        $xmlString = '<?xml version="1.0" encoding="ISO-8859-1"?>' . $xmlString;


        $xml = simplexml_load_string($xmlString);
        if ($xml === false) {
            return 'Error while loadig xml';
        }

        $result = [];
        foreach ($xml->transaction as $transaction) {
            $transactionData = [];
            foreach ($transaction as $key => $value) {
                $transactionData[$key] = (string)$value;
            }
            $result[] = $transactionData;
        }

        return $result;
    }

    public function getResponseArray(): array
    {
        return $this->responseArray;
    }

}