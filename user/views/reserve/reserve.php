<?php

    if (isset($_POST['reserve']))
    {
        $conn = mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $people = $_POST['people'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        $sql = "INSERT INTO reservations (name, email, phone, people, date, time) VALUES ('$name', '$email', '$phone', '$people', '$date', '$time')";

        if ($conn->query($sql) === TRUE) 
        {
            echo "<script>alert('Reservation added successfully.'); window.location.href = ''; </script>";
            header("Location: /restaurant/user/public/index.php?page=reserve");
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>