<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "recipe_book";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>