<?php

require_once __DIR__ . 'dbConnection.php';

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');

if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    exit(0);
}

$englishWord = $_POST['english'];
$elvishWord = $_POST['elvish'];

if (!isset($englishWord) || !isset($elvishWord))
{
    exit(0);
}

if (strlen($englishWord) > 100)
{
    exit(0);
}

if (strlen($elvishWord) > 100)
{
    exit(0);
}

global $connection;

$query = $connection->prepare('SELECT english, elvish FROM translated_words WHERE english = ? OR elvish = ?');
$query->execute($englishWord, $elvishWord);
$result = $query->fetch();

if ($result)
{
    exit(0);
}

$query = $connection->prepare('INSERT INTO translated_words(english, elvish) VALUES (?, ?)');
$query->execute($englishWord, $elvishWord);
echo json_encode('Words added to dictionary.');

