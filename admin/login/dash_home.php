<?php
session_start(); 
if (!isset($_SESSION['admin_name'])) {
    header("Location: login.php");
    exit();
}

$admin_name = $_SESSION['admin_name'];
$admin_role = $_SESSION['admin_role'];

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
    <link rel="stylesheet" href="dash_home.css">
    <title>ELYSIUM - Admin Dashboard</title>
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

            <button id="contactButton" class="optionsbtns">
                <i class="fa-solid fa-message"></i>
            </button>

            <?php if ($admin_role === 'super admin') { ?>
                <button id="adminButton" class="optionsbtns">
                    <i class="fa-solid fa-user-tie"></i>
                </button>
            <?php } ?>
        </div>
        <div class="dashboard-container  column d-flex  justify-content-center">
            <div class="header d-flex">
                <h1>ELYSIUM</h1>
            </div> 
            <div class="d-flex welcome justify-content-center text-center h-100 align-content-center"> 
                <h2 class="title text-center ">Welcome, <?php echo  htmlspecialchars(ucfirst($admin_name)); ?></h2>
            </div>   
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

        document.getElementById('contactButton').addEventListener('click', function () {
            window.location.href = '../contact/contact.php';
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
