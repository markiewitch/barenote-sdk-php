<?php
namespace Barenote\Barenote\SDK\Enum;


use MyCLabs\Enum\Enum;

/**
 * Class Method
 * @package BareNote\Barenote\SDK\Enum
 * @method static Method GET()
 * @method static Method POST()
 * @method static Method PUT()
 * @method static Method DELETE()
 */
class Method extends Enum
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
}