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
        $response = $this->transport->prepare(HttpMethod::GET(), self::URL_NOTES, "")->send();
        if ($response->code !== 200) {
            throw new \HttpException("Something went wrong while fetching notes");
        }

        $this->notes->clear();
        foreach ($response->body->notes as $note) {
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
        return $this->getAll()->find($id)->firstOrNull();
    }

    /**
     * Update existing note
     * @param Note $note
     * @return void
     * @throws \HttpException
     */
    public function update(Note $note)
    {
        $request  = $this->transport->prepare(
            HttpMethod::PUT(),
            self::URL_NOTES . "/{$note->getId()->getValue()}",
            json_encode($note)
        );
        $response = $request->send();

        if ($response->code !== 200) {
            throw new \HttpException("Something went wrong while saving note");
        }
    }

    /**
     * Insert a new note to the system
     * @param Note $note
     * @return NoteId
     * @throws \HttpException
     */
    public function insert(Note $note)
    {
        $request  = $this->transport->prepare(
            HttpMethod::POST(),
            self::URL_NOTES,
            json_encode($note)
        );
        $response = $request->send();

        if ($response->code !== 201) {
            throw new \HttpException("Something went wrong while saving new note.");
        }

        return new NoteId($response->body->id);
    }
}