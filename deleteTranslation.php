<?php

require_once __DIR__ . 'dbConnection.php';

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');

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

if (!$_SERVER['REQUEST_METHOD'] != 'DELETE')
{
    header("HTTP/1.1 405 Method Not Allowed");
    exit(0);
}

$englishWOrd = $_GET['word'];

if (!isset($englishWOrd))
{
    header("HTTP/1.1 422 Unprocessable Entity");
    exit(0);
}

global $connection;

$query = $connection->prepare('SELECT * FROM translated_words WHERE english = ?');
$query->execute($englishWOrd);
$result = $query->fetch();

if (!$result)
{
    header("HTTP/1.1 404 Not found");
    exit(0);
}

$deleteQuery = $connection->prepare('DELETE FROM translated_words WHERE enlgish = ?');
$deleteQuery->execute($englishWOrd);

echo json_encode('Translation for this word has been deleted');
header("HTTP/1.1 200 OK");
