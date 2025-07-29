<?php
require_once('config/db.php');
// Show all errors (for development)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Get and validate form data
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

// Check for empty fields
if (empty($name) || empty($email) || empty($message)) {
    echo "❌ Please fill in all required fields.";
    exit;
}

// Prepare insert
$sql = "INSERT INTO contact_form (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("sss", $name, $email, $message);
if ($stmt->execute()) {
    echo "✅ Your message has been sent successfully!";
} else {
    echo "❌ Failed to send message.";
}

$stmt->close();
$conn->close();
?>
