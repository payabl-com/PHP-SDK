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
        $xmlKey = key($array); // Получаем ключ массива
        $xmlString = $array[$xmlKey]; // Получаем XML-строку

        // Удаление некорректной части и добавление корректного объявления XML
        $xmlString = trim($xmlString); // Убираем лишние пробелы и переводы строк
        $xmlString = str_replace('"1.0" encoding="ISO-8859-1"?>', '', $xmlString);
        $xmlString = '<?xml version="1.0" encoding="ISO-8859-1"?>' . $xmlString;

        // Загрузка и парсинг XML
        $xml = simplexml_load_string($xmlString);
        if ($xml === false) {
            // Обработка ошибки парсинга XML
            return 'Ошибка при загрузке XML';
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