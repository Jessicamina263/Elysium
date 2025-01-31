<?php
$header_type = 'default';
$footer_type = 'reserve'; // Custom footer for reserve page
?>
<!-- Reserve page content -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/restaurant/user/public/assets/css/reserve.css">
    <title>ELYSIUM - Reservation Page</title>
    <link rel="icon" type="image/x-icon" href="../assets/icons/eee (1).ico">
</head>
<body>
<div class="header-image d-flex justify-content-center align-items-center">
        <!-- <img src="assets/image (5).png" alt="Restaurant Header"> -->
        <div class="header-text">
            <h1>Reservation </h1>
        </div>
    </div>

    <!-- Reservation Form -->
    <div class="container mt-5" id="form-section">
    <div class="form-container mb-5 ">
        <h2>Table Reservation</h2>
        <form  action="/restaurant/user/views/reserve/reserve.php" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone" required>
                </div>
                <div class="col-md-6">
                    <label for="people" class="form-label">Number of People</label>
                    <input type="number" class="form-control" id="people" name="people" placeholder="Enter number of people" min="1" max="50" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="date" class="form-label">Reservation Date</label>
                    <input type="date" class="form-control" id="date" name="date" min="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="time" class="form-label">Time</label>
                    <input type="time" class="form-control" id="time" name="time" required>
                </div>
            </div>
            <button type="submit" class="btn btn-custom" name="reserve">Reserve</button>
        </form>
        <div id="responseMessage" class="mt-3"></div> 
    </div>
    </div>

    <!-- Gallery Section -->
    <section class="gallery py-5">
        <div class="container">
            <h2 class="text-center text-navy mb-4">Gallery</h2>
            <div class="row g-2">
                <div class="col-md-4"><img src="/restaurant/user/public/assets/images/reserve/food7.jpg" class="img-fluid gallery-img" alt="Image 1"></div>
                <div class="col-md-4"><img src="/restaurant/user/public/assets/images/reserve/food8.jpg" class="img-fluid gallery-img" alt="Image 2"></div>
                <div class="col-md-4"><img src="/restaurant/user/public/assets/images/reserve/food5.jpg" class="img-fluid gallery-img" alt="Image 3"></div>
                <div class="col-md-4"><img src="/restaurant/user/public/assets/images/reserve/food4.jpg" class="img-fluid gallery-img" alt="Image 4"></div>
                <div class="col-md-4"><img src="/restaurant/user/public/assets/images/reserve/food9.jpg" class="img-fluid gallery-img" alt="Image 5"></div>
                <div class="col-md-4"><img src="/restaurant/user/public/assets/images/reserve/food6.jpg" class="img-fluid gallery-img" alt="Image 6"></div>
            </div>
        </div>
    </section>
    <?php
        include '/opt/lampp/htdocs/restaurant/user/views/reserve/reserve.php';
    ?>
</body>
</html>