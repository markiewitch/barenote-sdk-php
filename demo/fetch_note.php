<?php
use Barenote\BarenoteClient;
use Barenote\Domain\Identity\NoteId;

require_once '../vendor/autoload.php';

$client = new BarenoteClient("http://localhost:8080");
$client->authenticate("dummy", "account");
$note = $client->getNotesEndpoint()->getOne(new NoteId(1));

var_dump($note);