<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "fypdiploma";

// Using Object-Oriented MySQLi
$conn = new mysqli($host, $user, $password, $database);

$db = mysqli_connect($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
