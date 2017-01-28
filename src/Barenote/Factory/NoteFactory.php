<?php
namespace Barenote\Factory;

use Barenote\Domain\Identity\CategoryId;
use Barenote\Domain\Identity\NoteId;
use Barenote\Domain\Identity\UserId;
use Barenote\Domain\Note;

class NoteFactory
{
    public static function fromJson($payload)
    {
        return static::fromArray(json_decode($payload, true));
    }

    public static function fromArray(array $data)
    {
        return (new Note())
            ->setId(new NoteId($data['id']))
            ->setCategoryId(new CategoryId($data['category_id']))
            ->setUserId(new UserId($data['user_id']))
            ->setContent($data['content'])
            ->setTitle($data['title']);
    }
}