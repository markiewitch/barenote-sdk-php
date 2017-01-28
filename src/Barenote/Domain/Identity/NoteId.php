<?php
namespace Barenote\Domain\Identity;

/**
 * Class NoteId
 * @package Barenote\Domain\Identity
 */
class NoteId
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}