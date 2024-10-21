<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "riddle";

// Create connection
$conn = new mysqli($servername, $username, $password, database: $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>