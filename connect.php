<?php

$servername = 'localhost';
$username   = 'amirali';
$password   = 'amirali123';
$database   = 'webapp';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>

