<?php
$header_type = 'default';
$footer_type = 'menu'; // Custom footer for reserve page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELYSIUM - Menu Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/restaurant/user/public/assets/css/menu.css">
    <link rel="icon" type="image/x-icon" href="../assets/icons/eee (1).ico">
</head>
<body>
    <div>
        <div class="main m-0 p-0">
            <div class="d-flex justify-content-center align-items-center text-center flex-column" style="height: 94vh;">
                <p class="cinzel-decorative-regular p-0 m-0" style="opacity:0.87">MENU</p>
            </div>
        </div>
        <div class="main-content">
            <div>
                <div class="proddetails"></div>
                <?php
                    include '/opt/lampp/htdocs/restaurant/user/views/menu/menu.php';
                ?>
            </div>
            <div>
                <div class="arcanimate"></div>
                <div id="filteredCarousel" class="carousel-container">
                    <div id="filteredCarouselContent" class="carousel-inner">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" id="prevBtn" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="position: absolute; top: 170%">
                <i class="fa-solid fa-chevron-left" style="color: rgba(161, 161, 161, 0.76); font-size: 35px"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" id="nextBtn" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="position: absolute; top: 170%">
                <i class="fa-solid fa-chevron-right" style="color: rgba(161, 161, 161, 0.76); font-size: 35px"></i>
                <span class="visually-hidden">Next</span>
            </button>

            <div style="display: flex; justify-content: center;">
                <i class="fa-solid fa-utensils" id="utensils-icon" style="font-size: 45px; cursor: pointer; margin-right: 20px;position: absolute; left: 45%; top: 190%;"></i>
                <i class="fa-solid fa-martini-glass-citrus" id="drinks-icon" style="font-size: 45px; cursor: pointer;position: absolute; left: 50%; top: 190%;"></i>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/restaurant/user/public/assets/js/menu.js"></script>
</body>
</html>