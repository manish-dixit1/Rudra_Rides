<?php
require_once(__DIR__ . '/../../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validate required fields
    if (empty($name) || empty($email) || empty($message)) {
        header("Location: /contact.html?status=failed&error=missing_fields");
        exit();
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    
    if (!$stmt) {
        header("Location: /contact.html?status=failed&error=prepare_failed");
        exit();
    }

    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        header("Location: /contact.html?status=success");
        exit();
    } else {
        header("Location: /contact.html?status=failed&error=execute_failed");
        exit();
    }
}
?> 