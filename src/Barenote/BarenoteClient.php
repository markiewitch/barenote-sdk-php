<?php
namespace Barenote;


use Barenote\Domain\Credentials;
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
     */
    public function __construct()
    {
        $this->transport = new HttpfulTransport();
        $this->transport->setHost("http://localhost:8080");

        $this->endpoints['authentication'] = new Authentication($this->transport);
    }

    public function authenticate(string $username, string $password)
    {
        $credentials = new Credentials($username, $password);
        $this->getAuthenticationEndpoint()->authenticate($credentials);
    }

    /**
     * @return Authentication
     */
    public function getAuthenticationEndpoint()
    {
        return $this->endpoints['authentication'];
    }
}