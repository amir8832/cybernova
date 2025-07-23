<?php
$db_host = "db"; // Replace with your MySQL server host in docker compose
$db_servername = "localhost"; // Replace with your MySQL server hostname or IP address
$db_username = "reyhane"; // Replace with your MySQL username
$db_password = "123"; // Replace with your MySQL password
$db_database = "myapp"; // Replace with the name of your MySQL database
$backupPath = "/var/www/test/admin/backups/";

// Create a connection
 $conn = new mysqli($db_servername, $db_username, $db_password, $db_database);
//
// // Check the connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
     }
 ?>

