<?php
namespace Barenote\Transport;

use Barenote\Domain\Token;
use Barenote\Enum\HttpMethod;
use Httpful\Response;

interface Transport
{
    public function isAuthenticated(): bool;

    public function setToken(Token $token);

    public function sendRequest(HttpMethod $method, string $url, string $body): Response;
}