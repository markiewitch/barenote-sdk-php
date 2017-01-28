<?php
namespace Barenote\Transport;

use Barenote\Enum\HttpMethod;
use Httpful\Request;
use Httpful\Response;

/**
 * Class HttpfulTransport
 * @package Barenote\Transport
 */
class HttpfulTransport extends BaseTransport
{
    public function sendRequest(HttpMethod $method, string $url, string $body): Response
    {
        switch ($method) {
            case HttpMethod::POST():
                $request = $this->post($url, $body);
                break;
            default:
                throw new \Exception("Method not recognised");
        }

        if ($this->isAuthenticated()) {
            $request->addHeader("Authorization", "Bearer " . $this->token->getValue());
        }

        return $request->send();
    }

    /**
     * @param $url
     * @param $body
     * @return Request
     */
    private function post(string $url, string $body)
    {
        return Request::post($this->host . $url, $body);
    }
}