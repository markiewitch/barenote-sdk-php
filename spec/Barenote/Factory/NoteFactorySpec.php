<?php
namespace spec\Barenote\Factory;

use Barenote\Domain\Identity\CategoryId;
use Barenote\Domain\Identity\NoteId;
use Barenote\Domain\Identity\UserId;
use Barenote\Domain\Note;
use PhpSpec\ObjectBehavior;

class NoteFactorySpec extends ObjectBehavior
{
    function it_converts_json()
    {
        $payload = json_encode($this->getRandomNote());
        $this::fromJson($payload)->shouldReturnAnInstanceOf(Note::class);
    }

    private function getRandomNote()
    {
        return (new Note())
            ->setId(new NoteId(rand(1, 100)))
            ->setUserId(new UserId(rand(1, 100)))
            ->setCategoryId(new CategoryId(rand(1, 100)))
            ->setTitle("Note title")
            ->setContent("Note content.");
    }

    function it_instantiates_from_array()
    {
        $arr = $this->getRandomNote()->jsonSerialize();
        $this::fromArray($arr)->shouldHaveType(Note::class);
    }
}
