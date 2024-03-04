<?php
$servername = "localhost:3333";
$username = "root";
$password = "";
$database = "TP2";
// Create a connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
