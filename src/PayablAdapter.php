<?php

namespace Payable\SdkPhp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

class PayablAdapter
{
    const PAYABL_API_VERSION = 'v1.0';
    private Client $client;
    private string $secret;
    public function __construct (?AbstractResource $resource = null){
        $baseUrl = $_ENV['PAYABL_BASE_URL'];
        $this->secret = $_ENV['PAYABL_SECRET'];
        $this->client = new Client(
            [
                'base_url'=>$baseUrl."/",
                'headers'=>[
                    'User-Agent'=>'Payabl PHP-SDK v.0.1',
                    'Accept'=>'application/json',
                    'Content-Type'=>'application/json'
                ],
            ]
        );
    }


    public function handle (string $httpMethod, string $url, string $responseDTOClass){
        $error = [];
        try {
            $response =  $this->$httpMethod($url);
            $data = $response->toArray();

            if ($response->getStatusCode() !== 200 ){
                $error = $this->generateError($data);
            }
        } catch (ServerException $e){
            $response = $e->getResponse();
            $data  = json_decode((string) $response->getBody(), true);
            $error = $this->generateError($data);
        }

        if ($error) {
            throw new PayablException($error);
        }

        try {
            $res = new $responseDTOClass($data);
        } catch (UnknownProperties $e) {
            $error = [
                'reason' => 'Response validation: Unknown properties',
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
            throw new PayablException($error);
        }

        return $res;

    }

    public function get(string $url, array $options = []): PayablResponse
    {
        return $this->request('GET', $url, $options);
    }

    public function post(string $url, array $options = []): PayablResponse
    {
        $options = $this->getArrayWithSignature($options);
        return $this->request('POST', $url, $options);
    }

    private function request(string $method, $uri = '', array $options = []): PayablResponse
    {
        // здесь логика саоздания сигнатуры
        $method = strtolower($method);
        try {
            $response = $this->client->$method($uri, $options);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return new PayablResponse($response);
    }


    private function getArrayWithSignature(array $params):array
    {
        $params['signature'] = $this->generateSignature($params);
        return $params;
    }

    private function generateSignature($params): string {

        $params = $this->prepareArray();
        // Сортируем параметры по ключам в алфавитном порядке
        ksort($params);

        // Конкатенируем значения параметров
        $concatenatedParams = implode('', array_values($params));

        // Добавляем секрет к концу строки
        $concatenatedParams .= $this->secret;

        // Вычисляем SHA-1 хеш строки и приводим его к нижнему регистру
        return strtolower(sha1($concatenatedParams));
    }


    /**
     * Generates error object from "bad" Payabl response (status of response >=400)
     */
    #[ArrayShape(['message' => "mixed", 'reason' => "mixed", 'code' => "mixed"])]
    public function generateError(array $data, int $status): array
    {
        // For Payabl response
        if (array_key_exists('httpReason', $data)) {
            return [
                'message' => $data['messageTranslations']['en'],
                'reason' => $data['httpReason'],
                'code' => $data['httpCode'],
            ];
        }

        // For WikiMedia response
        if (array_key_exists('detail', $data)) {
            return [
                'message' => $data['detail'],
                'reason' => $data['title'],
                'code' => $status
            ];
        }

        return [
            'message' => 'Unknown errored response format',
            'reason' => 'Bad response',
            'code' => 0
        ];
    }
    

}