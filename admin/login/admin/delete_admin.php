<?php
header('Content-Type: application/json');
$conn = mysqli_connect('localhost', 'root', '', 'restaurant', 3307, '/opt/lampp/var/mysql/mysql.sock');

if (!$conn) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed: ' . mysqli_connect_error()]);
    exit;
}
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'] ?? '';

if (empty($id)) {
    echo json_encode(['success' => false, 'error' => 'ID is required.']);
    exit;
}
$sql = "DELETE FROM admins WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'error' => 'Preparation of query failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Deletion failed: ' . $stmt->error]);
}

$stmt->close();
$conn->close();

?>
