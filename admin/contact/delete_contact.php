<?php

    $conn = mysqli_connect('localhost', 'root', '', 'restaurant', 3307, '/opt/lampp/var/mysql/mysql.sock');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $id = $_POST['id'];
        $sql = "DELETE FROM contactus WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: contact.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    $conn->close();

?>