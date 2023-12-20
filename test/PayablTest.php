<?php


use PayableSdkPhp\Exceptions\PayablException;
use PayableSdkPhp\Payabl;
use PayableSdkPhp\Resources\Payabl\PaymentResource;
use PHPUnit\Framework\TestCase;

class PayablTest extends TestCase
{
    public function testConstructorWithDotEnvLoading()
    {
        new Payabl();
        $this->assertArrayHasKey('PAYABL_BASE_URL', $_ENV);

    }

    public function testSuccessPaymentResource()
    {
        $payab  = new Payabl();
        $resource = $payab->payment();
        $this->assertInstanceOf(PaymentResource::class, $resource);
    }

    public function testGetNoneExistingResource()
    {
        $this->expectException(PayablException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('The specified resource (tickets) does not exist');

        $payabl     = new Payabl();
        $payabl->tickets();
    }

}
