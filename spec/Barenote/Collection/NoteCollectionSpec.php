<?php

namespace spec\Barenote\Collection;

use Barenote\Collection\NoteCollection;
use Barenote\Domain\Identity\NoteId;
use Barenote\Domain\Note;
use PhpSpec\ObjectBehavior;

class NoteCollectionSpec extends ObjectBehavior
{
    const NOTE_ID = 1;

    function it_is_initializable()
    {
        $this->shouldHaveType(NoteCollection::class);
    }

    function it_filters_by_id_value(Note $note)
    {
        $note->getId()->willReturn(new NoteId(self::NOTE_ID));
        $this->beConstructedWith([$note]);

        $this->find(new NoteId(self::NOTE_ID))
            ->firstOrNull()
            ->shouldReturnAnInstanceOf(Note::class);
    }

    function it_returns_null_for_nonexistent_notes(Note $note)
    {
        $note->getId()->willReturn(new NoteId(self::NOTE_ID));
        $this->beConstructedWith([$note]);

        $this->find(new NoteId(self::NOTE_ID + 1))
            ->firstOrNull()
            ->shouldReturn(null);
    }
}
