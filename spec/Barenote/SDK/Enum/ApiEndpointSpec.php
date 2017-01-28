<?php
namespace spec\Barenote\SDK\Enum;

use Barenote\SDK\Enum\ApiEndpoint;
use PhpSpec\ObjectBehavior;

/**
 * Class ApiEndpointSpec
 * @package spec\Barenote\SDK\Enum
 * @mixin ApiEndpoint
 */
class ApiEndpointSpec extends ObjectBehavior
{
    function it_has_login_endpoint()
    {
        $this->beConstructedThrough('LOGIN');
        $this->isResourceful()->shouldReturn(false);
        $this->shouldThrow(new \Exception("This endpoint does not contain any resources"))->duringFormatForResource(1);
    }
}
