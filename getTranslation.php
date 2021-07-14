<?php

require_once __DIR__ . 'dbConnection.php';

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');

if ($_SERVER['REQUEST_METHOD'] != 'GET')
{
    header("HTTP/1.1 405 Method Not Allowed");
    exit(0);
}

$englishWord = $_GET['word'];

if (!isset($englishdWord))
{
    header("HTTP/1.1 422 Unprocessable Entity");
    exit(0);
}

global $connection;

$query = $connection->prepare('SELECT * FROM translated_words WHERE english = ?');
$query->execute($englishdWord);
$result = $query->fetch();

if (!$result)
{
    header("HTTP/1.1 404 Not Found");
    exit(0);
}

echo json_encode($result);
header("HTTP/1.1 200 OK");

