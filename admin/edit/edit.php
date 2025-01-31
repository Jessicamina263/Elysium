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

if (isset($_POST['savingchange'])) {
    $prodid = mysqli_real_escape_string($conn, $_POST['prodid']);
    $prodname = mysqli_real_escape_string($conn, $_POST['prodname']);
    $prodprice = mysqli_real_escape_string($conn, $_POST['prodprice']);
    $prodrate = mysqli_real_escape_string($conn, $_POST['prodrate']);
    $proddesc = mysqli_real_escape_string($conn, $_POST['proddesc']);
    $prodtype = mysqli_real_escape_string($conn, $_POST['prodtype']);
    $prodimage = $_FILES['prodimage']['name'];

    if (!empty($prodimage)) {
        $targetDir = "../assets/" . $prodtype . "/";
        $targetFile = $targetDir . basename($prodimage);

        if (move_uploaded_file($_FILES['prodimage']['tmp_name'], $targetFile)) {
        } else {
            echo "<script>alert('Error uploading the image.');</script>";
            exit;
        }
    } else {
        $prodimage = $_POST['old_prodimage'];
    }

    $updateQuery = "UPDATE `menu` SET
                        `prodname` = '$prodname',
                        `prodprice` = '$prodprice',
                        `prodrate` = '$prodrate',
                        `proddesc` = '$proddesc',
                        `prodtype` = '$prodtype',
                        `prodimage` = '$prodimage'
                    WHERE `prodid` = '$prodid'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Product details updated successfully.'); window.location.href = ''; </script>";
    } else {
        echo "<script>alert('Error updating the product: " . mysqli_error($conn) . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELYSIUM - Edit Product</title>
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
            <button class="optionsbtns">
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
        
        <div class="container mt-5 search-container" style="display: flex;flex-direction: column;">
            <div class="header">
                <h1>ELYSIUM</h1>
                <h2 class="title">Product Edit</h2>
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
                        <input type="text" class="form-control" id="searchValue" name="searchValue" placeholder="Enter Product ID or Name" required>
                    </div>
                    
                    <div class="center-btn-container ">
                        <button type="submit" name="passdata" class="btn btn-primary subbutton" style="width: 260px;margin-bottom: 5%">Search for a Product</button>
                    </div>
                </form>
            </div>

            <?php
                if ($res && mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $imagePath = "../assets/" . $row['prodtype'] . "/" . $row['prodimage'];
                        $productTypes = ['Appetizers', 'Breakfast', 'Lunch', 'Dessert', 'Hot Drinks', 'Cold Drinks'];

                        echo "<form action='' method='post' enctype='multipart/form-data' class='product-form'>
                            <div class='mb-3'>
                                <i class='fa-solid fa-hashtag icons'></i>
                                <label for='prodid' class='form-label'>Product ID:</label>
                                <input type='text' id='prodid' name='prodid' class='form-control' value='" . htmlspecialchars($row['prodid']) . "' required>
                            </div>

                            <div class='mb-3'>
                                <i class='fa-solid fa-utensils icons'></i>
                                <label for='prodname' class='form-label'>Product Name:</label>
                                <input type='text' id='prodname' name='prodname' class='form-control' value='" . htmlspecialchars($row['prodname']) . "' required>
                            </div>

                            <div class='mb-3'>
                                <i class='fa-solid fa-dollar-sign icons'></i>
                                <label for='prodprice' class='form-label'>Product Price:</label>
                                <input type='number' id='prodprice' name='prodprice' class='form-control' step='0.01' value='" . htmlspecialchars($row['prodprice']) . "' required>
                            </div>

                            <div class='mb-3'>
                                <i class='fa-solid fa-star icons'></i>
                                <label for='prodrate' class='form-label'>Product Rating:</label>
                                <input type='number' id='prodrate' name='prodrate' class='form-control' step='0.01' value='" . htmlspecialchars($row['prodrate']) . "' required>
                            </div>

                            <div class='mb-3'>
                                <i class='fa-solid fa-file-prescription icons'></i>
                                <label for='proddesc' class='form-label'>Product Description:</label>
                                <textarea id='proddesc' name='proddesc' class='form-control' required>" . htmlspecialchars($row['proddesc']) . "</textarea>
                            </div>

                            <!-- Product Type Dropdown -->
                            <div class='mb-3'>
                                <i class='fa-solid fa-bowl-food icons'></i>
                                <label for='prodtype' class='form-label'>Product Type:</label>
                                <div class='dropdown'>
                                    <button class='btn dropdown-toggle' type='button' id='prodtypeDropdown' data-bs-toggle='dropdown' aria-expanded='false'>
                                        " . (isset($row['prodtype']) && !empty($row['prodtype']) ? ucfirst($row['prodtype']) : 'Select Product Type') . "
                                    </button>
                                    <ul class='dropdown-menu' aria-labelledby='prodtypeDropdown'>";
                                        foreach ($productTypes as $type) 
                                        {
                                            echo "<li><button class='dropdown-item' type='button' onclick=\"selectProdType('" . htmlspecialchars($type) . "')\">" . ucfirst($type) . "</button></li>";
                                        }
                                    echo "</ul>
                                </div>
                                <!-- Hidden input to hold selected type -->
                                <input type='hidden' id='prodtype' name='prodtype' value='" . htmlspecialchars($row['prodtype']) . "' required>
                            </div>

                            <script>
                                function selectProdType(type) {
                                    document.getElementById('prodtype').value = type;
                                    document.getElementById('prodtypeDropdown').innerText = type.charAt(0).toUpperCase() + type.slice(1);
                                }
                            </script>

                            <!-- Product Image Upload -->
                            <div class='mb-3'>
                                <i class='fa-solid fa-image icons'></i>
                                <label for='prodimage' class='form-label'>Product Image:</label>
                                <div class='file-upload'>
                                    <label for='prodimage' class='custom-file-label'>
                                        " . (isset($row['prodimage']) && !empty($row['prodimage']) ? htmlspecialchars($row['prodimage']) : 'Choose File') . "
                                    </label>
                                    <input type='file' id='prodimage' name='prodimage' class='file-input' onchange='updateFileName(this)'>
                                    <span class='file-name'>" . (isset($row['prodimage']) && !empty($row['prodimage']) ? htmlspecialchars($row['prodimage']) : 'No file chosen') . "</span>
                                </div>
                            </div>

                            <!-- Hidden input to store the old product image name -->
                            <input type='hidden' name='old_prodimage' value='" . htmlspecialchars($row['prodimage']) . "'>

                            <div class='d-flex justify-content-center'>
                                <button type='submit' name='savingchange' class='btn btn-success' style='width: 100%'>Save Changes</button>
                            </div>
                        </form>";
                    }
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('addButton').addEventListener('click', function () {
            window.location.href = '../add/add.php';
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
