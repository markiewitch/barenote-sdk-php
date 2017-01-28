<?php
namespace Barenote\Endpoint;

use Barenote\Collection\NoteCollection;
use Barenote\Domain\Identity\NoteId;
use Barenote\Domain\Note;
use Barenote\Enum\HttpMethod;
use Barenote\Exception\NotAuthenticated;
use Barenote\Factory\NoteFactory;
use Barenote\Transport\Transport;

class Notes
{
    const URL_NOTES = '/api/note';
    /**
     * @var Transport
     */
    private $transport;

    /**
     * @var NoteCollection
     */
    private $notes;

    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
        $this->notes     = new NoteCollection();
    }

    public function getAll()
    {
        if ($this->notes->getUpdatedAt() === null) {
            $this->fetch();
        }

        return $this->notes;
    }

    /**
     * Fetch most recent data to cache
     * @throws NotAuthenticated
     * @throws \HttpException
     */
    private function fetch()
    {
        if (!$this->transport->isAuthenticated()) {
            throw new NotAuthenticated("You must be authenticated to fetch notes");
        }
        $notes = $this->transport->prepare(HttpMethod::GET(), self::URL_NOTES, "")->send();
        if ($notes->code !== 200) {
            throw new \HttpException("Something went wrong while fetching notes");
        }

        $this->notes->clear();
        foreach ($notes->body->notes as $note) {
            var_dump((array)$note);
            $this->notes->add(NoteFactory::fromArray((array)$note));
        }
        $this->notes->update();
    }

    /**
     * @param NoteId $id
     * @return Note|null
     */
    public function getOne(NoteId $id)
    {
        if ($this->notes->getUpdatedAt() === null) {
            $this->fetch();
        }

        return $this->notes->find($id)->firstOrNull();
    }

    /**
     * @param Note $note
     * @return NoteId
     * @throws \HttpException
     */
    public function saveOne(Note $note)
    {
        if ($note->getId() !== null) {
            $request = $this->transport->prepare(
                HttpMethod::PUT(),
                self::URL_NOTES . "/{$note->getId()->getValue()}",
                json_encode($note)
            );
        } else {
            $request = $this->transport->prepare(
                HttpMethod::POST(),
                self::URL_NOTES,
                json_encode($note)
            );
        }
        $response = $request->send();

        if ($response->code > 201 || $response->code < 200) {
            throw new \HttpException("Something went wrong while saving note");
        }

        return new NoteId($response->body->id);
    }
}