<?php
// Database connection variables
$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

// Create a connection
$conn = new mysqli($serverName, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
