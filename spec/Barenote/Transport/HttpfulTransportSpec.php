<?php
namespace spec\Barenote\Transport;

use Barenote\Enum\HttpMethod;
use Barenote\Transport\HttpfulTransport;
use PhpSpec\ObjectBehavior;

/**
 * Class HttpfulTransportSpec
 * @package spec\Barenote\Transport
 * @mixin HttpfulTransport
 */
class HttpfulTransportSpec extends ObjectBehavior
{
    function let()
    {
        $this->setHost("http://google.com");
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(HttpfulTransport::class);
    }

    function it_concatenates_host_for_get()
    {
        $request = $this->prepare(HttpMethod::GET(), "/some/url");
        $request->uri->shouldEqual("http://google.com/some/url");
    }

    function it_concatenates_host_for_post()
    {
        $request = $this->prepare(HttpMethod::POST(), "/some/url", "");
        $request->uri->shouldEqual("http://google.com/some/url");
    }

    function it_sends_body_with_post()
    {
        $str     = "qwerty";
        $request = $this->prepare(HttpMethod::POST(), "/post", $str);
        $request->payload->shouldEqual($str);
    }
}
