<?php
namespace Barenote\Domain;

/**
 * Class Credentials
 * @package BareNote\Barenote\Domain
 */
class Credentials implements \JsonSerializable
{
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;

    /**
     * Credentials constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function jsonSerialize()
    {
        return ['username' => $this->username, 'password' => $this->password];
    }
}