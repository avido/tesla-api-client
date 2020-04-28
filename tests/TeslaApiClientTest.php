<?php
namespace Tests;

use Avido\TeslaApiClient\Exceptions\BadCredentialsException;
use Avido\TeslaApiClient\TeslaApiClient;

class BaseClientTest extends TestCase
{
    /**
     * @test
     */
    public function wrongCredentialsTest()
    {
        $this->expectException(BadCredentialsException::class);
        $this->setMockException('Errors/authenticationExceptionResponse.json');
        $client = new TeslaApiClient('fake', 'fake');
    }

    /**
     * @testx
     */
    public function okayCredentials()
    {
        $this->assertTrue($this->client->isAuthenticated());
    }
}
