<?php
namespace Barenote\Transport;

use Barenote\Enum\HttpMethod;
use Httpful\Request;

/**
 * Class HttpfulTransport
 * @package Barenote\Transport
 */
class HttpfulTransport extends BaseTransport
{
    public function prepare(HttpMethod $method, string $url, string $body = ""): Request
    {
        switch ($method) {
            case HttpMethod::POST():
                $request = $this->post($url, $body);
                break;
            case HttpMethod::GET():
                $request = $this->get($url);
                break;
            default:
                throw new \Exception("Method not recognised");
        }

        if ($this->isAuthenticated()) {
            $request->addHeader("Authorization", "Bearer " . $this->token->getValue());
        }
        $request->sends('application/json');
        $request->expects('application/json');

        return $request;
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

    /**
     * @param string $url
     * @return Request
     */
    private function get(string $url)
    {
        return Request::get($this->host . $url);
    }
}