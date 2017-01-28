<?php
namespace Barenote\Domain\Identity;

/**
 * Class CategoryId
 * @package Barenote\Domain\Identity
 */
class CategoryId
{
    /**
     * @var int
     */
    private $value;

    /**
     * CategoryId constructor.
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