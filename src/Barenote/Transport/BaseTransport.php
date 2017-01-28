<?php
namespace Barenote\Transport;

use Barenote\Domain\Token;

/**
 * Class BaseTransport
 * @package Barenote\Transport
 */
abstract class BaseTransport implements Transport
{
    /**
     * @var string
     */
    protected $host;

    /**
     * @var Token
     */
    protected $token;

    public function isAuthenticated(): bool
    {
        return $this->token !== null;
    }

    public function setToken(Token $token): void
    {
        $this->token = $token;
    }

    public function setHost(string $host)
    {
        $this->host = $host;
    }
}