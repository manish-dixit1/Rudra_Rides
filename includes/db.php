<?php
// Database configuration for Vercel deployment
$servername = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost';
$username   = $_ENV['DB_USER'] ?? getenv('DB_USER') ?? 'root';
$password   = $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?? '';
$dbname     = $_ENV['DB_NAME'] ?? getenv('DB_NAME') ?? 'rudra_rides';

// For local development fallback
if ($servername === 'localhost') {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'rudra_rides';
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_errno) {
    die('Database connection failed: ' . $conn->connect_error);
}
?>