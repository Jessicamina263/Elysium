<?php
    $admin_name = $_SESSION['admin_name'];
    $admin_role = $_SESSION['admin_role'];
    
    session_start(); 
    if (!isset($_SESSION['admin_name']) || $_SESSION['admin_role'] !== 'super admin') {
        header("Location: ../login/dash_home.php");
        exit();
    }

    $conn = mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    if (isset($_POST['passdata'])) 
    {
        $chefname = $_POST['chefname'];
        $specialty = trim($_POST['specialty']);
        $chefimage = $_FILES['chefimage']['name']; 
        
        if (empty($specialty)) 
        {
            echo "Specialty cannot be empty!";
        } else 
        {
            $query = $conn->prepare("INSERT INTO chefs (chefname, specialty, chefimage) VALUES (?, ?, ?)");
            $query->bind_param("sss", $chefname, $specialty, $chefimage);

            if ($query->execute()) {
                echo "<script>alert('Employee added successfully.'); window.location.href = ''; </script>";
            } else {
                echo "Error: " . $query->error;
            }

            $query->close();
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELYSIUM - Employment Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="display: flex; flex-direction: row;">
        <div style="display: flex; flex-direction: column;" class="divbtns">
            <button id="addButton" class="optionsbtns">
                <i class="fa-solid fa-plus"></i>
            </button>
            <button id="editButton" class="optionsbtns">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button id="deleteButton" class="optionsbtns">
                <i class="fa-solid fa-trash"></i>
            </button>
            <button id="reserveButton" class="optionsbtns">
                <i class="fa-solid fa-chair"></i>
            </button>
            <button class="optionsbtns">
                <img src="../assets/apron.svg" alt="" style='width: 55%'>
            </button>
            <button id="contactButton" class="optionsbtns">
                <i class="fa-solid fa-message"></i>
            </button>
            <button id="adminButton" class="optionsbtns">
                <i class="fa-solid fa-user-tie"></i>
            </button>
        </div>

        <div class="container mt-5" style="margin-top: 2%">
            <div class="header">
                <h1>ELYSIUM</h1>
                <h2 class="title">Employment Dashboard</h2>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <i class="fa-solid fa-utensils icons"></i>
                    <label for="chefname" class="form-label">Chef Name :</label>
                    <input type="text" id="chefname" name="chefname" class="form-control" required>
                </div>

                <div class="mb-3">
                    <i class="fa-solid fa-file-prescription icons"></i>
                    <label for="specialty" class="form-label">Specialty :</label>
                    <textarea id="specialty" name="specialty" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <i class="fa-solid fa-image icons"></i>
                    <label for="chefimage" class="form-label">Chef Image :</label>
                    <div class="file-upload">
                    <label for="chefimage" class="custom-file-label" style="color: #3d0d18;background-color: rgba(189, 186, 186, 0.76);">Choose File</label>
                    <input type="file" id="chefimage" name="chefimage" class="file-input" required>
                    <span class="file-name">No file chosen</span>
                    </div>
                </div>              

                <div class="center-btn-container ">
                    <button type="submit" name="passdata" class="btn btn-primary subbutton" style="width: 100%;">Add Employee</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('addButton').addEventListener('click', function () {
            window.location.href = '../add/add.php';
        });

        document.getElementById('editButton').addEventListener('click', function () {
            window.location.href = '../edit/edit.php';
        });

        document.getElementById('deleteButton').addEventListener('click', function () {
            window.location.href = '../delete/delete.php';
        });

        document.getElementById('reserveButton').addEventListener('click', function () {
            window.location.href = '../reserve/reserve.php';
        });

        document.getElementById('contactButton').addEventListener('click', function () {
            window.location.href = '../contact/contact.php';
        });

        document.getElementById('adminButton').addEventListener('click', function () {
            window.location.href = '../login/admin/admin.php';
        });

    </script>
</body>
</html>