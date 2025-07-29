<?php
// includes/db.php
$servername = 'localhost';
$username   = 'root';
$password   = '';           // your MySQL password
$dbname     = 'rudra_rides';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_errno) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>
