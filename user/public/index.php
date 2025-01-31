<?php
// Set default page
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Validate allowed pages
$allowed_pages = ['home', 'about', 'reserve', 'menu', 'contact'];
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

// Debug information (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define the correct path to views directory
$views_path = "../views";

// Check if the page file exists
$page_path = "$views_path/$page/index.php";
if (!file_exists($page_path)) {
    die("Error: Page file not found: $page_path");
}

// Default header and footer types
$header_type = 'default';
$footer_type = 'default';

// Include the page content first to allow it to set header/footer types
ob_start();
include $page_path;
$content = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>

    <!-- CSS Paths -->
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <?php 
    // Include header with dynamic type
    if (file_exists("$views_path/header.php")) {
        include "$views_path/header.php";
    } else {
        echo "Error: Header file not found";
    }
    ?>
    
    <main>
        <?php echo $content; ?>
    </main>

    <?php 
    // Include footer with dynamic type
    if (file_exists("$views_path/footer.php")) {
        include "$views_path/footer.php";
    } else {
        echo "Error: Footer file not found";
    }
    ?>
</body>
</html>