<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/../includes/db.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("❌ You must be logged in to make a booking.");
}

// Get and sanitize form data
$activity_name = trim($_POST['activity'] ?? '');
$date = $_POST['date'] ?? '';
$people = intval($_POST['participants'] ?? 0);
$fullname = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$user_id = $_SESSION['user_id'] ?? 0;
$booking_type = 'activity';
$destination = null; // No destination input

// Validate required fields
if (
    empty($activity_name) || empty($date) || empty($people) ||
    empty($fullname) || empty($email) || empty($phone)
) {
    die("❌ All fields are required.");
}

// Prepare query without reference_id
$stmt = $conn->prepare("INSERT INTO bookings (user_id, fullname, email, phone, booking_type, destination, date, people, created_at)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");

if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}

// Bind parameters (s = string, i = integer)
$stmt->bind_param(
    "issssssi",
    $user_id,
    $fullname,
    $email,
    $phone,
    $booking_type,
    $activity_name,  // store activity name as "destination"
    $date,
    $people
);

// Execute
if ($stmt->execute()) {
    echo "✅ Activity booking successful!";
} else {
    echo "❌ Booking failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
