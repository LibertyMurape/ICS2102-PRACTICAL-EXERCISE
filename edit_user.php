<?php
session_start();
include 'connect.php';

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

// Check if a username is provided
if (!isset($_GET['username'])) {
    echo "No user specified.";
    exit();
}

$username = $_GET['username'];
$error_message = '';
$success_message = '';

// Retrieve user information
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit();
}

// Handle form submission for updating user info
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET email = ?, role = ? WHERE username = ?");
    $stmt->bind_param("sss", $email, $role, $username);

    if ($stmt->execute()) {
        $success_message = "User updated successfully!";
    } else {
        $error_message = "Failed to update user.";
    }
}

// Include the HTML view template
include 'edit_user_view.html';
