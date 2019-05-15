<?php
$servername = "localhost";
$username   = "root";
$password   = "#Qwerty3";
$db         ="elVecino";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";
?>
