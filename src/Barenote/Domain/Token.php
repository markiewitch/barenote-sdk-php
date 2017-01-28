<?php
namespace Barenote\Domain;

/**
 * Class Token
 * @package BareNote\Barenote\Domain
 */
class Token
{
    private $value;

    public function __construct(string $token)
    {
        $this->value = $token;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}