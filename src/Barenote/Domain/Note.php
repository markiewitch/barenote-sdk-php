<?php
namespace Barenote\Domain;

use Barenote\Domain\Identity\CategoryId;
use Barenote\Domain\Identity\NoteId;
use Barenote\Domain\Identity\UserId;

class Note implements \JsonSerializable
{
    /**
     * @var NoteId
     */
    private $id;
    /**
     * @var UserId
     */
    private $userId;
    /**
     * @var CategoryId
     */
    private $categoryId;
    /**
     * @var string[]
     */
    private $tags;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $content;

    public function __construct()
    {
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param UserId $userId
     * @return Note
     */
    public function setUserId(UserId $userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return CategoryId
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param CategoryId $categoryId
     * @return Note
     */
    public function setCategoryId(CategoryId $categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return \string[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param \string[] $tags
     * @return Note
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Note
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Note
     */
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    function jsonSerialize()
    {
        return [
            'id'          => $this->getId() === null ?: $this->getId()->getValue(),
            'user_id'     => $this->userId->getValue(),
            'category_id' => $this->categoryId->getValue(),
            'title'       => $this->title,
            'content'     => $this->content
        ];
    }

    /**
     * @return NoteId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param NoteId $id
     * @return Note
     */
    public function setId(NoteId $id)
    {
        $this->id = $id;

        return $this;
    }
}