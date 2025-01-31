<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'restaurant', 3307, '/opt/lampp/var/mysql/mysql.sock');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login-btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM admins WHERE Name = '$name' AND password = '$password'";
    $result = $conn->query($query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = $result->fetch_assoc();
        $_SESSION["admin_name"] = $name;
        $_SESSION["admin_role"] = $row['authorization'];

        header("location: dash_home.php");
        exit();
    } else {
        $errorMsg = "Invalid Name or Password.";
    }
}

mysqli_close($conn);
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+AU+TAS+Guides&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Charmonman:wght@400;700&family=Cinzel+Decorative:wght@400;700;900&family=Italianno&family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+AU+TAS+Guides&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="home.css">
</head>

<body>
<div class="d-flex align-items-center m-0 p-0 " style="height: 100vh;">
<div class="text-center mg m-0 p-0 d-flex justify-content-center align-items-center text-center">
  <p class="cinzel-decorative-regular p-0 mx-5 mb-0 text-center" style="opacity:0.87">ELYSIUM
  
  </p>
  <div class="text-center justify-content-center d-flex align-items-center login-div m-0 p-0">
    <h1 class="fw-bold log text-center ">LOGIN</h1>
    <?php
$errorMsg = '';
?>

<form class="login-form" id="loginForm" method="post">
    <?php if ($errorMsg): ?>
        <div class="error"><?php echo $errorMsg; ?></div>
    <?php endif; ?>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" />
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter your password"  />
    
    <span class="error" id="errorMsg"></span>
    
    <button type="submit" name="login-btn">Login</button>
</form>

<script>
    const form = document.getElementById('loginForm');
    const nameInput = document.getElementById('name');
    const passwordInput = document.getElementById('password');
    const errorMsg = document.getElementById('errorMsg');
    const errorMsgn = document.getElementById('errorMsgn');

    form.addEventListener('submit', function(event) {
        let valid = true;
        let errorMessages = [];
       
       
        errorMsg.innerHTML = '';  
        
        if (nameInput.value.trim() === '' && passwordInput.value.trim() === '') {
            valid = false;
            errorMessages.push(" The Name and the Password are required.");
        }
       else if(nameInput.value.trim() === ''){
            valid = false;
            errorMessages.push(" The Name is required.");
        }
        else if (passwordInput.value.trim() === '') {
            valid = false;
            errorMessages.push("The Password is required.");
        } else if (passwordInput.value.length < 6) {
            valid = false;
            errorMessages.push("Password must be at least 6 characters long.");
        }

        if (!valid) {
            errorMsg.innerHTML = errorMessages.join('<br>');
           
            event.preventDefault();  
        }
    });
</script>


        </div>
</div>

  
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoA6DkWMoKx4gVRWtWQGaT7EhlQi3oQUJOvSNgwWCj5iF9N" crossorigin="anonymous"></script>
</body>

</html>