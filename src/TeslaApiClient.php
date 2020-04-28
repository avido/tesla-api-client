<?php
namespace Avido\TeslaApiClient;

use Avido\TeslaApiClient\Exceptions\BadCredentialsException;
use Avido\TeslaApiClient\Traits\Commands;
use Avido\TeslaApiClient\Traits\State;
use GuzzleHttp\Client as Http;
use GuzzleHttp\ClientInterface as HttpInterface;
use GuzzleHttp\Exception\BadResponseException;

class TeslaApiClient
{
    use State, Commands;

    const CLIENT_ID = "81527cff06843c8634fdc09e8ac0abefb46ac849f38fe1e431c2ef2106796384";
    const CLIENT_SECRET = "c7257eb71a564034f9419ee651c7d0e5f7aa6bfbd18bafb5c5c033b093bb2fa3";
    const API_ADDRESS = "https://owner-api.teslamotors.com";

    /**
     * @var array|null
     */
    private static $token = null;
    /**
     * @var HttpInterface|null
     */
    private static $http;


    /**
     * TeslaApiClient constructor.
     * @param string|null $email
     * @param string|null $password
     * @throws BadCredentialsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct(?string $email = null, ?string $password = null)
    {
        if (!is_null($email) && !is_null($password)) {
            $this->authenticate($email, $password);
        }
    }


    /**
     * Authenticate to set token
     * @param string $email
     * @param string $password
     * @throws BadCredentialsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function authenticate(string $email, string $password): void
    {
        $params  = [
            'email' => $email,
            'password' => $password,
            'client_id' => self::CLIENT_ID,
            'client_secret' => self::CLIENT_SECRET,
            'grant_type' => 'password'
        ];
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        try {
            $response = static::getHttp()->request('POST', self::API_ADDRESS . "/oauth/token", [
                'headers' => $headers,
                'form_params' => $params
            ]);

            $token = json_decode((string)$response->getBody(), true);
            $token['expires_at'] = time() + $token['expires_in'] ?? 0;
            static::$token = $token;
        } catch (BadResponseException $e) {
            throw new BadCredentialsException();
        }
    }

    /**
     * Clear the credentials of the client. This will effectively sign out.
     */
    public static function clearCredentials(): void
    {
        static::$token = null;
    }

    /**
     * Check if the client is authenticated.
     *
     * @return bool
     */
    public static function isAuthenticated(): bool
    {
        if (!is_array(static::$token)) {
            return false;
        }

        if (!isset(static::$token['expires_at']) || !isset(static::$token['access_token'])) {
            return false;
        }

        return static::$token['expires_at'] > time();
    }

    /**
     * GET Method
     * @param string $endpoint
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $endpoint, array $options = [])
    {
        return $this->request('GET', $endpoint, $options);
    }

    /**
     * Post method
     * @param string $endpoint
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(string $endpoint, array $options = [])
    {
        return $this->request('POST', $endpoint, $options);
    }

    /**
     * Make request to api
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, string $uri, array $options = [])
    {
        $options = static::addAuthenticationOptions($options);
        $response = static::getHttp()->request($method, $uri, $options);
        $body = (string)$response->getBody();
        $response = json_decode($body, true);
        return $response;
    }

    /**
     * Add authentication bearer headers
     * @param array $options
     * @return array
     */
    private static function addAuthenticationOptions(array $options): array
    {
        if (!static::isAuthenticated() || !is_array(static::$token)) {
            return $options;
        }

        $authorization = [
            'Authorization' => sprintf('Bearer %s', static::$token['access_token']),
        ];
        $options['headers'] = array_merge($options['headers'] ?? [], $authorization);

        return $options;
    }

    /**
     * Set Client
     * @param HttpInterface $http
     */
    public function setHttp(HttpInterface $http)
    {
        static::$http = $http;
    }

    /**
     * Get Client
     * @return HttpInterface
     */
    private static function getHttp(): HttpInterface
    {
        if (!static::$http instanceof HttpInterface) {
            static::$http = new Http([
                'base_uri' => self::API_ADDRESS,
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);
        }

        return static::$http;
    }
}
