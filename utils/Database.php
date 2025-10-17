<?php

$DB_SERVER = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_DATABASE = "imdb";

$conn = null;

function getConn()
{
    global $conn, $DB_SERVER, $DB_USER, $DB_PASSWORD, $DB_DATABASE;
    if ($conn === null) {
        $conn = new mysqli($DB_SERVER, $DB_USER, $DB_PASSWORD, $DB_DATABASE);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    return $conn;
}


