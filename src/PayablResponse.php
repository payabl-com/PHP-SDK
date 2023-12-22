<?php

namespace PayablSdkPhp;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\StreamInterface;


class PayablResponse
{
    private int $statusCode;
    private string $content;

    public function __construct(Response $response)
    {
        $this->statusCode = $response->getStatusCode();
        $this->content = (string) $response->getBody();
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContent(): string
    {
        return $this->content;
    }


    public function toArray(): array
    {
        parse_str($this->getContent(), $resultArr);
        return $resultArr;
    }

}