<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../config/db.php');

// Check if user is logged in (optional based on your logic)
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to book.");
}

// Sanitize & get form data
$fullname      = $_POST['fullname'] ?? '';
$email         = $_POST['email'] ?? '';
$phone         = $_POST['phone'] ?? '';
$booking_type  = $_POST['booking_type'] ?? '';
$destination   = $_POST['destination'] ?? '';
$date   = $_POST['date'] ?? '';
$people  = $_POST['people'] ?? '';

// Validate mandatory fields
if (
    empty($fullname) || empty($email) || empty($phone) ||
    empty($booking_type) || empty($destination) ||
    empty($date) || empty($people)
) {
    die("All fields are required.");
}

// Prepare SQL
$stmt = $conn->prepare("INSERT INTO bookings (fullname, email, phone, booking_type, destination, date, people, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssssi", $fullname, $email, $phone, $booking_type, $destination, $date, $people);

// Execute
if ($stmt->execute()) {
    echo "✅ Booking successful!";
    // Optionally redirect:
    // header("Location: ../thank_you.html");
    // exit;
} else {
    echo "❌ Booking failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
