<?php

namespace PayablSdkPhp;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use PayablSdkPhp\Exceptions\PayablException;
use PayablSdkPhp\Resources\AbstractResource;
use PHPUnit\Exception;

class PayablAdapter
{
    const PAYABL_API_VERSION = 'v1.0';
    private Client $client;
    private string $secret;
    private string $merchantId;

    public function __construct(?AbstractResource $resource = null)
    {
        $baseUrl = $_ENV['PAYABL_BASE_URL'];
        $this->secret = $_ENV['PAYABL_SECRET'];
        $this->merchantId = $_ENV['PAYABL_MERCHANT_ID'];
        $this->client = new Client(
            [
                'base_uri' => $baseUrl . "/",
                'headers' => [
                    'User-Agent' => 'Payabl PHP-SDK v.0.1',
                    'Accept' => 'text/plain',
                    'Content-Type' => 'application/json'
                ],
            ]
        );
    }


    public function handle(string $httpMethod, string $url, array $options , string $responseDTOClass)
    {
        $error = [];
        try {

            $response = $this->$httpMethod($url, $options);
            $data = $response->toArray();

            if ($response->getStatusCode() !== 200) {
                $error = $this->generateError($data);
            }
        } catch (ServerException $e) {
            $response = $e->getResponse();
            $data = json_decode((string)$response->getBody(), true);
            $error = $this->generateError($data);
        }


        if ($error) {
            throw new PayablException($error);
        }


        try {
            $res = new $responseDTOClass($data);

        } catch (Exception $e) {
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

    public function post(string $url,  array $options = []): PayablResponse
    {
        $options = $this->getArrayWithSignature($options);

        return $this->request('POST', $url, ['form_params' => $options]);
    }

    private function request(string $method, $uri = '', array $options = []): PayablResponse
    {
        $method = strtolower($method);
        try {
            $response = $this->client->$method($uri, $options);

        } catch (ClientException $e) {

            $response = $e->getResponse();
        }

        return new PayablResponse($response);
    }


    private function getArrayWithSignature(array $params): array
    {
        $params['merchantid'] = $this->merchantId;

        $params['signature'] = $this->generateSignature($params);

        return $params;
    }

    private function generateSignature($params): string
    {
        ksort($params);
        $concatenatedParams = implode('', array_values($params));
        $concatenatedParams .= $this->secret;
        return strtolower(sha1($concatenatedParams));
    }


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

        // For Payabl response
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