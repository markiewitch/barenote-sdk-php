<?php
namespace Barenote\SDK\Request;


use Barenote\Barenote\SDK\Enum\Method;
use Barenote\SDK\Enum\ApiEndpoint;

interface ApiRequest
{
    public function getMethod(): Method;

    public function getEndpoint(): ApiEndpoint;
}