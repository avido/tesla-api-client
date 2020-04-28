<?php
namespace Tests;

use Avido\TeslaApiClient\TeslaApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @package Tests
 * @todo fix phpunit.xml to ignore this file
 */
abstract class TestCase extends BaseTestCase
{
    protected $mockHandler;
    public $client;
    protected $defaultResponseHeader = [
        'Content-Type' => [
            'application/json; charset=utf-8'
        ]
    ];

    public function setUp(): void
    {
        // setup mock for client.
        $this->mockHandler = new MockHandler();
        // load client
        $this->client = new TeslaApiClient();
        $this->client->setHttp(new Client([
            'handler' => $this->mockHandler
        ]));
    }

    /**
     * Get Mockfile
     * @param string $type
     * @return string|null
     * @throws \Exception
     */
    public function getMockfile(string $type): ?string
    {
        $file = __DIR__ . "/Mocks/{$type}";
        if (file_exists($file)) {
            return file_get_contents($file);
        }
        throw new \Exception("Mockfile not found '{$type}'");
    }

    /**
     * Set Mock Response
     * @param string $type - mockfile
     * @param int $httpCode
     * @throws \Exception
     */
    public function setMock(string $type, $httpCode = 200)
    {
        // setup mock for client.
        $this->mockHandler = new MockHandler();
        // load client
        $this->client = new TeslaApiClient();
        $this->client->setHttp(new Client([
            'handler' => $this->mockHandler
        ]));

        $this->mockHandler->append(new Response(
            $httpCode,
            $this->defaultResponseHeader,
            $this->getMockfile($type)
        ));
    }

    /**
     * Set Mock Exception
     * @param string $type
     * @param int $httpCode
     * @throws \Exception
     */
    protected function setMockException(string $type, $httpCode = 400)
    {
        $response = new Response(400, [], $this->getMockfile($type));
        $msg = 'Error';
        $this->mockHandler->append(new BadResponseException(
            $msg,
            new Request('GET', 'test'),
            $response
        ));
    }
}
