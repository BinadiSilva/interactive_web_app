<?php
session_start();
include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $phone = trim($_POST["phone"]);
    $photo = trim($_POST["photo"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($email) || empty($address) || empty($phone) || empty($password)) {
        $_SESSION['register_message'] = "Please fill all required fields.";
        $_SESSION['register_message_type'] = "error";
        header("Location: ../register.php");
        exit();
    }

    $check_sql = "SELECT id FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['register_message'] = "Email already registered.";
        $_SESSION['register_message_type'] = "error";
        header("Location: ../register.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, address, phone, photo, password)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $email, $address, $phone, $photo, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        header("Location: ../profile.php");
        exit();
    } else {
        $_SESSION['register_message'] = "Registration failed.";
        $_SESSION['register_message_type'] = "error";
        header("Location: ../register.php");
        exit();
    }
}