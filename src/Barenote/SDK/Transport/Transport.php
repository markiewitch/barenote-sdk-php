<?php
namespace Barenote\SDK\Transport;

use Barenote\SDK\Request\ApiRequest;

interface Transport
{
    public function sendRequest(ApiRequest $request);
}