<?php

require_once __DIR__ . 'dbConnection.php';

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');

if (!isset($_COOKIE['token']))
{
    header("HTTP/1.1 401 Unauthorized");
    exit(0);
}

if (isset($_COOKIE['token']) != '49491af960d2f2c44f5047f59ea9ea4b')
{
    header("HTTP/1.1 403 Forbidden");
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
    header("HTTP/1.1 405 Method Not Allowed");
    exit(0);
}

$englishWord = $_POST['english'];
$elvishWord = $_POST['elvish'];

if (!isset($englishWord) || !isset($elvishWord))
{
    header("HTTP/1.1 422 Unprocessable Entity");
    exit(0);
}

if (strlen($englishWord) > 100)
{
    header("HTTP/1.1 422 Unprocessable Entity");
    exit(0);
}

if (strlen($elvishWord) > 100)
{
    header("HTTP/1.1 422 Unprocessable Entity");
    exit(0);
}

global $connection;

$query = $connection->prepare('SELECT english, elvish FROM translated_words WHERE english = ? OR elvish = ?');
$query->execute($englishWord, $elvishWord);
$result = $query->fetch();

if ($result)
{
    header("HTTP/1.1 422 Unprocessable Entity");
    exit(0);
}

$query = $connection->prepare('INSERT INTO translated_words(english, elvish) VALUES (?, ?)');
$query->execute($englishWord, $elvishWord);
echo json_encode('Words added to dictionary.');
header("HTTP/1.1 200 OK");
