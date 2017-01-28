<?php

namespace spec\Barenote\Endpoint;

use Barenote\Domain\Credentials;
use Barenote\Domain\Token;
use Barenote\Endpoint\Authentication;
use Barenote\Enum\HttpMethod;
use Barenote\Transport\Transport;
use Httpful\Response;
use PhpSpec\ObjectBehavior;

class AuthenticationSpec extends ObjectBehavior
{
    /**
     * @var Transport
     */
    protected $transport;

    function let(Transport $transport)
    {
        $this->transport = $transport;
        $this->beConstructedWith($transport);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Authentication::class);
    }

    function it_logs_user_with_correct_credentials(Response $response)
    {
        $this->transport->sendRequest(
            HttpMethod::POST(),
            '/api/login',
            '{"username":"dummy","password":"account"}'
        )
            ->willReturn($response);
        $response->code = 200;
        $response->body = new class()
        {
            public $access_token = "abcd";
        };

        $token = $this->authenticate(new Credentials("dummy", "account"));

        $token->shouldHaveType(Token::class);
        $token->getValue()->shouldReturn("abcd");
    }

    function it_throws_exception_for_invalid_credentials(Response $response)
    {
        $this->transport->sendRequest(
            HttpMethod::POST(),
            '/api/login',
            '{"username":"dummy","password":"account"}'
        )
            ->willReturn($response);
        $response->code = 403;
        $this->shouldThrow(new \Exception("Invalid credentials"))
            ->duringAuthenticate(new Credentials("dummy", "account"));
    }

    function it_returns_true_for_correct_registration(Response $response)
    {
        $this->transport->sendRequest(
            HttpMethod::POST(),
            '/api/register',
            '{"username":"dummy","password":"account","email":"me@me.me"}'
        )
            ->willReturn($response);
        $response->code = 201;
        $this->register("dummy", "me@me.me", "account")->shouldReturn(true);
    }
}
