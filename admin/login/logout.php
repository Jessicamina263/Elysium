<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['admin_name']);

    session_destroy();

    http_response_code(200);
    echo json_encode(['message' => 'Logged out successfully']);
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
