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

if (isset($_POST['passdata'])) {
    $prodname = $_POST['prodname'];
    $prodprice = (float) $_POST['prodprice'];
    $prodrate = (float) $_POST['prodrate'];
    $proddesc = trim($_POST['proddesc']);
    $prodtype = $_POST['prodtype'];
    $prodimage = $_FILES['prodimage']['name'];

    if (empty($proddesc)) 
    {
        echo "<script>alert('Product description cannot be empty!');</script>";
    } 
    else 
    {
        $query = $conn->prepare("INSERT INTO menu (prodname, prodprice, prodrate, proddesc, prodtype, prodimage) VALUES (?, ?, ?, ?, ?, ?)");
        $query->bind_param("ssdsss", $prodname, $prodprice, $prodrate, $proddesc, $prodtype, $prodimage);

        if ($query->execute()) 
        {
            echo "<script>alert('Product added successfully.'); window.location.href = ''; </script>";
        } 
        else 
        {
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
    <title>ELYSIUM - Addition Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div style="display: flex; flex-direction: row;">
        <div style="display: flex; flex-direction: column;" class="divbtns">
            <button class="optionsbtns">
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

        <div class="container mt-5" style="margin-top: 2%">
            <div class="header">
                <h1>ELYSIUM</h1>
                <h2 class="title">Addition Dashboard</h2>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <i class="fa-solid fa-utensils icons"></i>
                    <label for="prodname" class="form-label">Product Name :</label>
                    <input type="text" id="prodname" name="prodname" class="form-control" required>
                </div>

                <div class="mb-3">
                    <i class="fa-solid fa-dollar-sign icons"></i>
                    <label for="prodprice" class="form-label">Product Price :</label>
                    <input type="number" id="prodprice" name="prodprice" class="form-control" step="0.01" required>
                </div>

                <div class="mb-3">
                    <i class="fa-solid fa-star icons"></i>
                    <label for="prodrate" class="form-label">Product Rating :</label>
                    <input type="number" id="prodrate" name="prodrate" class="form-control" step="0.01" required>
                </div>

                <div class="mb-3">
                    <i class="fa-solid fa-file-prescription icons"></i>
                    <label for="proddesc" class="form-label">Product Description :</label>
                    <textarea id="proddesc" name="proddesc" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <i class="fa-solid fa-bowl-food icons"></i>
                    <label for="prodtype" class="form-label">Product Type :</label>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle subbutton" type="button" id="prodtypeDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: rgba(189, 186, 186, 0.76);color: #3d0d18;">
                            Select Product Type
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="prodtypeDropdown">
                            <li><button class="dropdown-item" type="button" onclick="selectType('Appetizers')">Appetizers</button></li>
                            <li><button class="dropdown-item" type="button" onclick="selectType('Breakfast')">Breakfast</button></li>
                            <li><button class="dropdown-item" type="button" onclick="selectType('Lunch')">Lunch</button></li>
                            <li><button class="dropdown-item" type="button" onclick="selectType('Dessert')">Dessert</button></li>
                            <li><button class="dropdown-item" type="button" onclick="selectType('Hot Drinks')">Hot Drinks</button></li>
                            <li><button class="dropdown-item" type="button" onclick="selectType('Cold Drinks')">Cold Drinks</button></li>
                        </ul>
                    </div>
                    <input type="hidden" id="prodtype" name="prodtype" value="" required>
                </div>

                <div class="mb-3">
                    <i class="fa-solid fa-image icons"></i>
                    <label for="prodimage" class="form-label">Product Image :</label>
                    <div class="file-upload">
                        <label for="prodimage" class="custom-file-label" style="color: #3d0d18;background-color: rgba(189, 186, 186, 0.76);">Choose File</label>
                        <input type="file" id="prodimage" name="prodimage" class="file-input" required>
                        <span class="file-name">No file chosen</span>
                    </div>
                </div>              

                <div class="center-btn-container ">
                    <button type="submit" name="passdata" class="btn btn-primary subbutton" style="width: 100%;">Add Product</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
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
            document.getElementById("prodtype").value = type;
            document.getElementById("prodtypeDropdown").textContent = type.charAt(0).toUpperCase() + type.slice(1);
        }
        const fileInput = document.getElementById('prodimage');
        const fileNameSpan = document.querySelector('.file-name');

        fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            fileNameSpan.textContent = fileInput.files[0].name;
        } else {
            fileNameSpan.textContent = 'No file chosen';
        }
        });

    </script>
</body>
</html>
