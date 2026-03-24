<?php
session_start();
include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($email) || empty($password)) {
        $_SESSION['login_message'] = "Please fill all fields.";
        $_SESSION['login_message_type'] = "error";
        header("Location: ../login.php");
        exit();
    }

    $sql = "SELECT id, username, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION['user_id'] = $user["id"];
            $_SESSION['username'] = $user["username"];
            $_SESSION['email'] = $user["email"];

            $stmt->close();
            header("Location: ../profile.php");
            exit();
        }
    }

    $stmt->close();
    $_SESSION['login_message'] = "Invalid email or password.";
    $_SESSION['login_message_type'] = "error";
    header("Location: ../login.php");
    exit();
}

header("Location: ../login.php");
exit();
?>