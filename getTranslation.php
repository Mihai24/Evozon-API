<?php

require_once __DIR__ . 'dbConnection.php';

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: GET');

if ($_SERVER['REQUEST_METHOD'] != 'GET')
{
    exit(0);
}

$englishWord = $_GET['word'];

if (!isset($englishdWord))
{
    exit(0);
}

global $connection;

$query = $connection->prepare('SELECT eldish FROM translated_words WHERE english = ?');
$query->execute($englishdWord);
$result = $query->fetch();

