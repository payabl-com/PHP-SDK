<?php

namespace PayablSdkPhp\DTO\Responses;

class SessionResponse
{

    public int $transactionId = 0;
    public ?string $sessionId = null;
    public ?string $startUrl = null;
    public int $userId = 0;

    public function __construct(array $data)
    {
        $this->transactionId = (int)$data['transactionid'] ?? 0;
        if (isset($data['sessionid']))
            $this->sessionId = $data['sessionid'] ?? null;

        if (isset($data['start_url']))
            $this->startUrl = $data['start_url'] ?? null;

        if (isset($data['user_id']))
            $this->userId = (int)$data['user_id'] ?? 0;
    }
}