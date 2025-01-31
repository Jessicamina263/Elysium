<?php
    if (isset($_POST["submit"])) 
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $message=$_POST['message'];



    $conn =mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo '<script> alert=("Connected successfully")</script>';
    
    $query ="INSERT INTO `contactus`(`name`, `email`, `phone`, `message`) VALUES ('$name','$email','$phone','$message')";
    $result = mysqli_query($conn,$query);

    if (!$result) {
        echo "Error: " . mysqli_error($conn);
    } else {
        echo '<script> alert=("Data inserted successfully.")</script>';
        header("Location: /restaurant/user/public/index.php?page=contact");
    }
    $conn->close();
   }
 ?>