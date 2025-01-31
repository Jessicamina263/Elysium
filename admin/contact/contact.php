<?php
    session_start(); 
    if (!isset($_SESSION['admin_name'])) {
        header("Location: login.php");
        exit();
    }

    $admin_name = $_SESSION['admin_name'];
    $admin_role = $_SESSION['admin_role'];

    if ($admin_role !== 'super admin' && $admin_role !== 'moderator') {
        header("Location: dash_home.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>ELYSIUM - Contact Dashboard</title>
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
            
            <?php if ($admin_role === 'super admin') { ?>
                <button id="employeeButton" class="optionsbtns">
                    <img src="../assets/apron.svg" alt="" style='width: 55%'>
                </button>
            <?php } ?>

            <button class="optionsbtns">
                <i class="fa-solid fa-message"></i>
            </button>

            <?php if ($admin_role === 'super admin') { ?>
                <button id="adminButton" class="optionsbtns">
                    <i class="fa-solid fa-user-tie"></i>
                </button>
            <?php } ?>
        </div>
        <div class="dashboard-container">
            <div class="header">
                <h1>ELYSIUM</h1>
                <h2 class="title">Contact Dashboard</h2>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $conn = mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");
                    
                        if ($conn->connect_error) 
                        {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT `id`, `name`, `email`, `phone`, `message` FROM `contactus`;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) 
                        {
                            while ($row = $result->fetch_assoc()) 
                            {
                                echo "
                                    <tr>
                                        <td>" . $row['id'] . "</td>
                                        <td>" . $row['name'] . "</td>
                                        <td>" . $row['email'] . "</td>
                                        <td>" . $row['phone'] . "</td>
                                        <td>" . $row['message'] . "</td>
                                        <td>
                                            <form method='POST' action='delete_contact.php' style='display:inline;'>
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <button type='submit' class='btn custom-delete-btn' style='background-color: #803333; color: #f4e8dc; border-radius: 10px'>X</button>
                                            </form>
                                        </td>
                                    </tr>";
                            }
                        } 
                        else 
                        {
                            echo "<tr><td colspan='7' class='text-center'>No Messages found</td></tr>";
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
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

        document.getElementById('employeeButton').addEventListener('click', function () {
            <?php if ($admin_role !== 'super admin') { ?>
                alert('You do not have permission to access this page.');
                return false;
            <?php } ?>
            window.location.href = '../employee/employee.php';
        });

        document.getElementById('adminButton').addEventListener('click', function () {
            <?php if ($admin_role !== 'super admin') { ?>
                alert('You do not have permission to access this page.');
                return false;
            <?php } ?>
            window.location.href = '../login/admin/admin.php';
        });
    </script>
</body>
</html>