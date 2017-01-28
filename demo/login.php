<?php
use Barenote\BarenoteClient;

require_once '../vendor/autoload.php';

$client = new BarenoteClient("http://localhost:8080");
$token  = $client->authenticate("dummy", "account");

echo $token->getValue();