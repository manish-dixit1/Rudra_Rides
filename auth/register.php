<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

    $stmt = $conn->prepare("
        INSERT INTO users (fullname, email, phone, password)
        VALUES (?, ?, ?, ?)
    ");
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param('ssss', $fullname, $email, $phone, $password);

    if ($stmt->execute()) {
        header('Location: ../login.html?msg=registered');
        exit;
    } else {
        die('Execute failed: ' . $stmt->error);
    }
}
