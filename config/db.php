<?php

$server_name = "localhost";
$username = "root";
$password = "Passw0rd";
$database = "cat_hostel";

// Create connection
$conn = new mysqli($server_name, $username, $password, $database);

// Check connection

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

// Enable us to use Headers
ob_start();

// Set sessions
if (!isset($_SESSION)) {
  session_start();
}

// Check logged in status
if (isset($_SESSION["user_id"])) {
  $logged_in = true;
} else {
  $logged_in = false;
}
