<?php
namespace Barenote\Enum;

use MyCLabs\Enum\Enum;

/**
 * Class HttpMethod
 * @package BareNote\Barenote\Transport
 * @method static HttpMethod GET()
 * @method static HttpMethod PUT()
 * @method static HttpMethod POST()
 * @method static HttpMethod DELETE()
 */
class HttpMethod extends Enum
{
    const GET = 'get';
    const PUT = 'put';
    const POST = 'post';
    const DELETE = 'delete';
}