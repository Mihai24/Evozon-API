<?php

$servername = "";
$username = "";
$password = "";

try {
    $connection = new PDO("mysql:host=$servername;dbname=", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;

} catch (PDOException $exception) {
    echo 'Connection fail: ' . $exception->getMessage();
}