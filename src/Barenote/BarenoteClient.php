<?php
namespace Barenote;


use Barenote\Domain\Credentials;
use Barenote\Domain\Token;
use Barenote\Endpoint\Authentication;
use Barenote\Transport\HttpfulTransport;
use Barenote\Transport\Transport;

class BarenoteClient
{
    /**
     * @var Transport
     */
    private $transport;
    private $endpoints = [];

    /**
     * BarenoteClient constructor.
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->transport = new HttpfulTransport();
        $this->transport->setHost($host);

        $this->endpoints['authentication'] = new Authentication($this->transport);
    }

    public function authenticate(string $username, string $password): Token
    {
        $credentials = new Credentials($username, $password);
        $token = $this->getAuthenticationEndpoint()->authenticate($credentials);
        $this->transport->setToken($token);

        return $token;
    }

    /**
     * @return Authentication
     */
    private function getAuthenticationEndpoint()
    {
        return $this->endpoints['authentication'];
    }
}