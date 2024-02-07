<?php
$hostname = 'localhost';
$username = 'root';
$pass = '';
$dbname = 'mediguard';

// Create connection
$conn = mysqli_connect($hostname,$username, $pass,$dbname );

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>