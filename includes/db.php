<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Ошибка соединения: " . mysqli_connect_error());
}
