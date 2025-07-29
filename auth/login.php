<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT id, fullname, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); // Assuming username is the email
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            session_start();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["fullname"] = $user["fullname"];
            header("Location: ../index.html");
            exit();
        } else {
            echo "❌ Invalid password.";
        }
    } else {
        echo "❌ User not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
