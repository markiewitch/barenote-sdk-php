<?php
namespace Barenote\Domain\Identity;

/**
 * Class UserId
 * @package Barenote\Domain\Identity
 */
class UserId
{
    /**
     * @var int
     */
    private $value;

    /**
     * UserId constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}