<?php
namespace Barenote\Endpoint;

use Barenote\Domain\Credentials;
use Barenote\Domain\Token;
use Barenote\Enum\HttpMethod;
use Barenote\Transport\Transport;

class Authentication
{
    const URL_LOGIN = '/api/login';
    const URL_REGISTER = '/api/register';

    /**
     * @var Transport
     */
    private $transport;

    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    public function authenticate(Credentials $credentials): Token
    {
        $method = HttpMethod::POST();
        $body   = json_encode($credentials);
        $url    = self::URL_LOGIN;

        $response = $this->transport->prepare($method, $url, $body)->send();

        if ($response->code === 403) {
            throw new \Exception("Invalid credentials");
        }

        return new Token($response->body->access_token);
    }

    public function register(string $username, string $email, string $password): bool
    {
        $method = HttpMethod::POST();
        $body   = json_encode(
            [
                'username' => $username,
                'password' => $password,
                'email'    => $email
            ]
        );
        $url    = self::URL_REGISTER;

        $response = $this->transport->prepare($method, $url, $body)->send();

        return $response->code == 201;
    }
}