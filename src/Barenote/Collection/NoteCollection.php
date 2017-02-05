<?php
namespace Barenote\Collection;

use Barenote\Domain\Identity\NoteId;
use Barenote\Domain\Note;

/**
 * Class NoteCollection
 * @package Barenote\Collection
 * @method Note[] toArray()
 */
class NoteCollection extends ArrayCollection
{
    private $lastUpdated = null;

    public function update()
    {
        $this->lastUpdated = microtime(true);
    }

    public function getUpdatedAt()
    {
        return $this->lastUpdated;
    }

    public function find(NoteId $id)
    {
        return $this->filter(
            function (Note $note) use ($id) {
                return $note->getId()->getValue() === $id->getValue();
            }
        );
    }
}