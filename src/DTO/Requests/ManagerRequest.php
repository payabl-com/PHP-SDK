<?php

namespace PayablSdkPhp\DTO\Requests;


class ManagerRequest
{
    public string $type;
    public string $start_date ;
    public string $end_date ;



    public function __construct(array $params)
    {
        foreach ($params as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}