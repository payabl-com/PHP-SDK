<?php

namespace Resources;

use Payable\SdkPhp\DTO\Responses\PaymentResults;
use Payable\SdkPhp\Exceptions\PayablException;
use Payable\SdkPhp\Payabl;
use PHPUnit\Framework\TestCase;


class PaymentResourceTest extends TestCase
{
    protected function setUp(): void
    {
        $this->payabl = new Payabl();

        parent::setUp();
    }

    /**
     *
     * @throws PayablException
     *
     */
    public function testPaymentAuthoriseSuccess()
    {
        $params   = ['q' => 'Jupiter', 'limit' => 5];
        $response = $this->payabl->payment()->payNow($params);

        $this->assertInstanceOf(PaymentResults::class, $response);
    }

}
