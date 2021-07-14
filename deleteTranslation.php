<?php

require_once __DIR__ . 'dbConnection.php';

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');

if (!$_SERVER['REQUEST_METHOD'] != 'DELETE')
{
    exit(0);
}

$englishWOrd = $_GET['word'];

if (!isset($englishWOrd))
{
    exit(0);
}

global $connection;

$query = $connection->prepare('SELECT english FROM translated_words WHERE english = ?');
$query->execute($englishWOrd);
$result = $query->fetch();

if (!$result)
{
    exit(0);
}

$deleteQuery = $connection->prepare('DELETE FROM translated_words WHERE enlgish = ?');
$deleteQuery->execute($englishWOrd);

echo json_encode('Translation for this word has been deleted');
