<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON data received.']);
    exit;
}

$name = $data['name'] ?? '';
$password = $data['password'] ?? '';
$role = $data['role'] ?? '';

if (empty($name) || empty($password) || empty($role)) {
    echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    exit;
}


$stmt = $conn->prepare("INSERT INTO admins (name, password, authorization) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $password, $role);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Admin added successfully.']);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
