<?php
namespace Barenote\Domain\Identity;

/**
 * Class NoteId
 * @package Barenote\Domain\Identity
 */
class NoteId
{
    /**
     * @var int
     */
    private $value;

    /**
     * NoteId constructor.
     * @param int $value
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