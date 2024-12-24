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

$conn = mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['deleterow'])) 
{
    $deleteid = mysqli_real_escape_string($conn, $_GET['deleterow']);
    $deleteQuery = "DELETE FROM `menu` WHERE `prodid` = '$deleteid'";

    if (mysqli_query($conn, $deleteQuery)) 
    {
        header("Location: delete.php");
    } 
    else 
    {
        echo "<script>alert('Error deleting row: " . mysqli_error($conn) . "');</script>";
    }
}
else if (isset($_GET['deletename'])) 
{
    $deleteid = mysqli_real_escape_string($conn, $_GET['deletename']);

    $deleteQuery = "UPDATE `menu` SET `prodname` = NULL WHERE `prodid` = '$deleteid'";

    if (mysqli_query($conn, $deleteQuery)) 
    {
        header("Location: delete.php");
    } 
    else 
    {
        echo "<script>alert('Error deleting Product Name: " . mysqli_error($conn) . "');</script>";
    }
}
else if (isset($_GET['deleteprice'])) 
{
    $deleteid = mysqli_real_escape_string($conn, $_GET['deleteprice']);

    $deleteQuery = "UPDATE `menu` SET `prodprice` = NULL WHERE `prodid` = '$deleteid'";

    if (mysqli_query($conn, $deleteQuery)) 
    {
        header("Location: delete.php");
    } 
    else 
    {
        echo "<script>alert('Error deleting Product Price: " . mysqli_error($conn) . "');</script>";
    }
}
else if (isset($_GET['deleterate'])) 
{
    $deleteid = mysqli_real_escape_string($conn, $_GET['deleterate']);

    $deleteQuery = "UPDATE `menu` SET `prodrate` = NULL WHERE `prodid` = '$deleteid'";

    if (mysqli_query($conn, $deleteQuery)) 
    {
        header("Location: delete.php");
    } 
    else 
    {
        echo "<script>alert('Error deleting Product Rating: " . mysqli_error($conn) . "');</script>";
    }
}
else if (isset($_GET['deletedesc'])) 
{
    $deleteid = mysqli_real_escape_string($conn, $_GET['deletedesc']);

    $deleteQuery = "UPDATE `menu` SET `proddesc` = NULL WHERE `prodid` = '$deleteid'";

    if (mysqli_query($conn, $deleteQuery)) 
    {
        header("Location: delete.php");
    } 
    else 
    {
        echo "<script>alert('Error deleting Product Description: " . mysqli_error($conn) . "');</script>";
    }
}
else if (isset($_GET['deletetype'])) 
{
    $deleteid = mysqli_real_escape_string($conn, $_GET['deletetype']);

    $deleteQuery = "UPDATE `menu` SET `prodtype` = NULL WHERE `prodid` = '$deleteid'";

    if (mysqli_query($conn, $deleteQuery)) 
    {
        echo "<script>alert('Product Deleted successfully.'); window.location.href = ''; </script>";
    } 
    else 
    {
        echo "<script>alert('Error deleting Product Type: " . mysqli_error($conn) . "');</script>";
    }
}
else if (isset($_GET['deleteimage'])) 
{
    $deleteid = mysqli_real_escape_string($conn, $_GET['deleteimage']);

    $deleteQuery = "UPDATE `menu` SET `prodimage` = NULL WHERE `prodid` = '$deleteid'";

    if (mysqli_query($conn, $deleteQuery)) 
    {
        header("Location: delete.php");
    } 
    else 
    {
        echo "<script>alert('Error deleting Product Image: " . mysqli_error($conn) . "');</script>";
    }
}



$res = false;
$searchType = '';
$searchValue = '';

if (isset($_POST['passdata'])) {
    $searchres = $_POST['searchres'];
    $searchValue = $_POST['searchValue'];

    $searchres = mysqli_real_escape_string($conn, $searchres);
    $searchValue = mysqli_real_escape_string($conn, $searchValue);

    if (empty($searchValue)) {
        echo "<script>alert('Please enter a value to search.');</script>";
        exit;
    }

    if ($searchres === 'Product ID') {
        $query = "SELECT * FROM `menu` WHERE `prodid` = '$searchValue'";
    } elseif ($searchres === 'Product Name') {
        $query = "SELECT * FROM `menu` WHERE `prodname` LIKE '%$searchValue%'";
    } else {
        echo "<script>alert('Invalid search type selected.');</script>";
        exit;
    }

    $res = mysqli_query($conn, $query);

    if (!$res) {
        echo "<script>alert('Error in query: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELYSIUM - Deletion Dashboard</title>
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
            <button class="optionsbtns">
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

        <div class="container mt-5 search-container" style="display: flex;flex-direction: column;">
            <div class="header">
                <h1>ELYSIUM</h1>
                <h2 class="title">Deletion Dashboard</h2>
            </div>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="d-flex">
                        <div>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle subbutton" type="button" id="searchresDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: rgba(189, 186, 186, 0.76);color: #571222">
                                    Search By
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="searchresDropdown">
                                    <li><button class="dropdown-item" type="button" onclick="selectType('Product ID')">Product ID</button></li>
                                    <li><button class="dropdown-item" type="button" onclick="selectType('Product Name')">Product Name</button></li>
                                </ul>
                            </div>
                            <input type="hidden" id="searchres" name="searchres" value="Product ID" required>
                        </div>
                        <input type="text" class="form-control" id="searchValue" name="searchValue" placeholder="Enter Product ID or Name" style="width: 350px" required>
                    </div>

                    <div class="center-btn-container ">
                        <button type="submit" name="passdata" class="btn btn-primary subbutton" style="width: 260px;margin-bottom: 5%">Search for a Product</button>
                    </div>
                </form>
            </div>
            <?php
            if ($res && mysqli_num_rows($res) > 0) {
                echo "
                    <table class='table-simple'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Rating</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Image</th>
                            </tr>
                        </thead>";
                        while ($row = mysqli_fetch_assoc($res)) 
                        {
                            $imagePath = "../assets/" . $row['prodtype'] . "/" . $row['prodimage'];
                            echo "
                                <tbody>
                                    <tr>
                                        <td>" . $row['prodid'] . "</td>
                                        <td>" . $row['prodname'] . "</td>
                                        <td>" . $row['prodprice'] . "</td>
                                        <td>" . $row['prodrate'] . "</td>
                                        <td>" . $row['proddesc'] . "</td>
                                        <td>" . $row['prodtype'] . "</td>
                                        <td>
                                            <img src='$imagePath' alt='Product Image' style='width: 85%; height: 85%'>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                                <div style='margin-top: 2%'>
                                    <div class='dropdown'>
                                        <button class='btn btn-secondary dropdown-toggle subbutton' type='button' id='searchresDropdown' data-bs-toggle='dropdown' aria-expanded='false'>
                                            Delete By
                                        </button>
                                        <ul class='dropdown-menu' aria-labelledby='searchresDropdown'>
                                            <li><a href='delete.php?deleterow=" . $row['prodid'] . "' class='btn btn-primary subbutton dropdown-item' type='button' onclick='selectType(\"Row\")'>Row</a></li>
                                            <li><a href='delete.php?deletename=" . $row['prodid'] . "' class='btn btn-primary subbutton dropdown-item' type='button' onclick='selectType(\"Name\")'>Name</a></li>
                                            <li><a href='delete.php?deleteprice=" . $row['prodid'] . "' class='btn btn-primary subbutton dropdown-item' type='button' onclick='selectType(\"Price\")'>Price</a></li>
                                            <li><a href='delete.php?deleterate=" . $row['prodid'] . "' class='btn btn-primary subbutton dropdown-item' type='button' onclick='selectType(\"Rate\")'>Rate</a></li>
                                            <li><a href='delete.php?deletedesc=" . $row['prodid'] . "' class='btn btn-primary subbutton dropdown-item' type='button' onclick='selectType(\"Desc\")'>Desc</a></li>
                                            <li><a href='delete.php?deletetype=" . $row['prodid'] . "' class='btn btn-primary subbutton dropdown-item' type='button' onclick='selectType(\"Type\")'>Type</a></li>
                                            <li><a href='delete.php?deleteimage=" . $row['prodid'] . "' class='btn btn-primary subbutton dropdown-item' type='button' onclick='selectType(\"Image\")'>Image</a></li>                            
                                        </ul>
                                    </div>
                                    <input type='hidden' id='searchres' name='searchres' value='Row' required>
                                </div>
                            ";
                        }
            } elseif (isset($_POST['passdata']) && mysqli_num_rows($res) === 0) {
                echo "<script>alert('No products found.');</script>";
            }
            ?>
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

        document.getElementById('reserveButton').addEventListener('click', function () {
            window.location.href = '../reserve/reserve.php';
        });

        document.getElementById('contactButton').addEventListener('click', function () {
            window.location.href = '../contact/contact.php';
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

        function selectType(type) {
            document.getElementById("searchres").value = type;
            document.getElementById("searchresDropdown").textContent = type;
        }
    </script>
</body>
</html>
