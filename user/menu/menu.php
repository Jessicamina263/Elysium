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
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../e.ico">
</head>
<body>
    <div>
        <div class="main m-0 p-0">
            <div class="d1 m-0 p-0">
                <nav class="row m-0" style="color: transparent; background-color:transparent">
                    <div class="container-fluid  my-1 row  my-2 justify-content-center align-items-center ms-5">
                        <div class=" ps-5 pe-3" style="margin-left: 18%">
                            <a href="../about/about.php" class="tit">About us</a>
                            <a href="../resrvation/reservation.php" class="tit ms-3">Reservation</a>
                            <a href="../home.html" class="tit" style="margin-left:17%; margin-right:17%">ELYSIUM</a>
                            <a class="tit ms-3">Menu</a>
                            <a href="../contactus/cont.php" class="tit ms-3">Contact us</a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="d-flex justify-content-center align-items-center text-center flex-column" style="height: 94vh;">
                <p class="cinzel-decorative-regular p-0 m-0" style="opacity:0.87">MENU</p>
            </div>
        </div>


        <div class="main-content">
            <div>
                <div class="proddetails">
                </div>
                <div id="originalCarousel" class="carousel-container active" style="margin-top: 10%;">
                    <div class="arcanimate"></div>
                    <div id="carouselExampleControls" class="carousel slide min-vh-100 d-flex flex-column justify-content-center align-items-center" data-bs-ride="carousel">
                        <div class="carousel-inner" id="originalCarouselContent">
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");

                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            $query = "
                                SELECT menu.prodid, menu.prodname, menu.prodprice, menu.prodrate, menu.proddesc, menu.prodtype, menu.prodimage, chefs.chefname
                                FROM menu
                                JOIN chefs ON menu.chefid = chefs.chefid
                            ";

                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                $chunks = array_chunk($products, 4);
                                $isActive = true;

                                foreach ($chunks as $chunk) {
                                    echo '<div class="carousel-item' . ($isActive ? ' active' : '') . '" style="z-index: 9999;width: 80%;margin-left: 12%">';
                                    echo '<div class="row w-100 justify-content-center">';
                                    
                                    foreach ($chunk as $row) {
                                        $imagePath = "../menu/assets/" . htmlspecialchars($row['prodtype']) . "/" . htmlspecialchars($row['prodimage']);
                                        echo '<div class="col-3" data-prodtype="' . htmlspecialchars($row['prodtype']) . '" data-prodname="' . htmlspecialchars($row['prodname']) . '" data-prodprice="' . htmlspecialchars($row['prodprice']) . '" data-proddesc="' . htmlspecialchars($row['proddesc']) . '" data-prodimage="' . htmlspecialchars($row['prodimage']) . '" data-chefname="' . htmlspecialchars($row['chefname']) . '" data-prodrate="' . htmlspecialchars($row['prodrate']) . '">';
                                        echo "
                                            <div class='card text-center'>
                                                <img src='$imagePath' class='card-img-top' alt='Product Image' style='height: 200px; object-fit: cover; opacity: 0.95;'>
                                                <div class='card-body'>
                                                    <h5 class='card-title' style='font-size: 17px; font-weight: bold;'>" . htmlspecialchars($row['prodtype']) . "</h5>
                                                    <h6 class='card-subtitle mb-2'>" . htmlspecialchars($row['prodname']) . "</h6>
                                                </div>
                                            </div>
                                        ";
                                        echo '</div>';
                                    }

                                    echo '</div>';
                                    echo '</div>';
                                    $isActive = false;
                                }
                            } else {
                                echo "<p>No menu items found.</p>";
                            }

                            mysqli_close($conn);
                            ?>
                        </div>
                    </div>
                </div>
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

            <div style="display: flex; justify-content: center; margin-top: 20px;">
                <i class="fa-solid fa-utensils" id="utensils-icon" style="font-size: 45px; cursor: pointer; margin-right: 20px;position: absolute; left: 45%; top: 190%;"></i>
                <i class="fa-solid fa-martini-glass-citrus" id="drinks-icon" style="font-size: 45px; cursor: pointer;position: absolute; left: 50%; top: 190%;"></i>
            </div>

            <script>
                const originalCarousel = document.getElementById('originalCarousel');
                const filteredCarousel = document.getElementById('filteredCarousel');
                const filteredCarouselContent = document.getElementById('filteredCarouselContent');
                const utensilsIcon = document.getElementById('utensils-icon');
                const drinksIcon = document.getElementById('drinks-icon');
                const originalCards = document.querySelectorAll('#originalCarousel .col-3');

                const filters = {
                    utensils: ['Appetizers', 'Breakfast', 'Lunch', 'Dessert'],
                    drinks: ['Hot Drinks', 'Cold Drinks']
                };

                let originalCarouselInstance, filteredCarouselInstance;

                function resetIcons() {
                    utensilsIcon.classList.remove('icon-active');
                    drinksIcon.classList.remove('icon-active');
                }

                function createCarouselItems(filteredCards) {
                    filteredCarouselContent.innerHTML = "";

                    if (filteredCards.length === 0) {
                        filteredCarouselContent.innerHTML = "<div class='carousel-item active'><p class='text-center'>No items found.</p></div>";
                        return;
                    }

                    const chunkSize = 4;
                    let activeClassAdded = false;

                    for (let i = 0; i < filteredCards.length; i += chunkSize) {
                        const chunk = filteredCards.slice(i, i + chunkSize);
                        const carouselItem = document.createElement('div');
                        carouselItem.classList.add('carousel-item');
                        if (!activeClassAdded) {
                            carouselItem.classList.add('active');
                            activeClassAdded = true;
                        }

                        const row = document.createElement('div');
                        row.classList.add('row', 'w-100', 'justify-content-center');
                        chunk.forEach(card => {
                            row.appendChild(card.cloneNode(true));
                        });

                        carouselItem.appendChild(row);
                        filteredCarouselContent.appendChild(carouselItem);
                    }

                    initializeFilteredCarousel();
                }

                function filterCards(filter) {
                    const filteredCards = Array.from(originalCards).filter(card => {
                        const prodType = card.getAttribute('data-prodtype');
                        return filter.includes(prodType);
                    });

                    filteredCarousel.classList.add('active');
                    originalCarousel.classList.remove('active');

                    createCarouselItems(filteredCards);
                }

                function initializeFilteredCarousel() {
                    if (filteredCarouselInstance) {
                        filteredCarouselInstance.dispose();
                    }

                    filteredCarouselInstance = new bootstrap.Carousel(filteredCarousel, {
                        interval: false,
                        wrap: true
                    });
                }

                function getBackgroundColorForRate(rate) {
                    if (rate >= 4.7) {
                        return 'rgb(194, 173, 152)';
                    } else if (rate >= 4.5) {
                        return 'rgb(165, 122, 79)';
                    } else {
                        return 'rgba(120,88,57,1)';
                    }
                }

                function updateProdDetails(card) {
                    const prodType = card.getAttribute('data-prodtype');
                    const prodName = card.getAttribute('data-prodname');
                    const prodDesc = card.getAttribute('data-proddesc');
                    const prodPrice = card.getAttribute('data-prodprice');
                    const prodImage = card.getAttribute('data-prodimage');
                    const chefName = card.getAttribute('data-chefname');
                    const prodRate = parseFloat(card.getAttribute('data-prodrate'));

                    const proddetails = document.querySelector('.proddetails');
                    proddetails.innerHTML = `
                        <div style="display: flex">
                            <img src="assets/${prodType}/${prodImage}" alt="" style="width: 400px; height: 400px;">
                            <div class="product-detail-content" style="text-align: center; margin-left: 40%">
                                <div id="rateBox" 
                                    style="font-size: 20px; font-weight: bold; color: black; width: 60px; margin-left: 45%; border-radius: 20px; height: 90px;">
                                    <p>${prodRate}</p>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <p>Chef ${chefName}</p>
                                <p>${prodDesc}</p>
                                <i class="fa-solid fa-dollar-sign icons"></i>
                                <p>${prodPrice}</p>
                            </div>
                        </div>
                    `;

                    const rateBox = document.getElementById('rateBox');
                    const backgroundColor = getBackgroundColorForRate(prodRate);
                    rateBox.style.backgroundColor = backgroundColor;
                }

                filteredCarouselContent.addEventListener('click', (e) => {
                    const card = e.target.closest('.col-3');
                    if (card) {
                        updateProdDetails(card);
                    }
                });

                originalCards.forEach(card => {
                    card.addEventListener('click', () => {
                        updateProdDetails(card);
                    });
                });

                utensilsIcon.addEventListener('click', () => {
                    resetIcons();
                    utensilsIcon.classList.add('icon-active');
                    filterCards(filters.utensils);
                });

                drinksIcon.addEventListener('click', () => {
                    resetIcons();
                    drinksIcon.classList.add('icon-active');
                    filterCards(filters.drinks);
                });

                originalCarouselInstance = new bootstrap.Carousel(originalCarousel, {
                    interval: false,
                    wrap: false
                });
            </script>

            <script>
                const arcanimate = document.getElementById('arcanimate');
                const carouselCards = document.querySelectorAll('.card');

                carouselCards.forEach(card => {
                    card.addEventListener('click', () => {
                        arcanimate.classList.add('active');

                        setTimeout(() => {
                            arcanimate.classList.remove('active');
                        }, 500);

                        card.classList.add('animate-in');

                        setTimeout(() => {
                            card.classList.remove('animate-in');
                            card.classList.add('visible');
                        }, 500);
                    });
                });
            </script>




        </div>



        <footer style="position: absolute; bottom: -130%">
            <div class="container">
                <div class="row">
                    <div class="col" id="company">   
                        <div class="col" id="services">
                            <h3>Why to choose Elysium </h3>
                            <div class="links">
                                <h3><i class="fas fa-star"></i> 25+</h3>
                                <h3><i class="fas fa-utensils"></i> 150+</h3>
                                <h3><i class="fas fa-concierge-bell"></i> 30+</h3>
                            </div>
                        </div>  
                    </div>
                    <div class="col" id="services">
                        <h3>Services</h3>
                        <div class="links">
                            <a href="#">Table Reservations</a>
                        <a href="#">Dine-In Experience</a>
                        <a href="#">Private Dining Rooms</a>
                        <a href="#">Special Event Hosting</a>
                        </div>
                    </div>
                    <div class="col" id="useful-links">
                        <h3>Links</h3>
                        <div class="links">
                            <a href="#">About</a>
                            <a href="#">Services</a>
                            <a href="#">Our Policy</a>
                            <a href="#">Help</a>
                        </div>
                    </div>
                    <div class="col" id="useful-links">
                        <h3>Contact</h3>
                    <div class="contact-details">
                        <i class="fa fa-location"></i>
                        <p>FF-42, Procube Avenue, <br> NY, USA</p>
                    </div>
                    <div class="contact-details">
                        <i class="fa fa-phone"></i>
                        <p>+1-8755856858</p>
                    </div>
                    <div class="social">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>