<?php
require_once '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    try {
        $query = "INSERT INTO contact_messages (name, email, subject, message) 
                 VALUES (:name, :email, :subject, :message)";
        
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":subject", $subject);
        $stmt->bindParam(":message", $message);

        if($stmt->execute()) {
            header("Location: ../contact.html?status=success");
            exit();
        } else {
            header("Location: ../contact.html?status=failed");
            exit();
        }
    } catch(PDOException $e) {
        header("Location: ../contact.html?error=" . urlencode($e->getMessage()));
        exit();
    }
}
?> 