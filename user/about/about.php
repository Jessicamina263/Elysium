<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELYSIUM - About Page</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="../e.ico">
</head>
<body>
    <div class="d1 m-0 p-0">
      <nav class="row m-0" style="color: transparent; background-color:transparent">
        <div class="container-fluid  my-1 row  my-2 justify-content-center align-items-center ms-5">
          <div class=" ps-5 pe-3" style="margin-top: 0.5%">
              <a href="#" class="tit">About us</a>
              <a href="../resrvation/reservation.php" class="tit ms-3">Reservation</a>
              <a href="../home.html" class="tit" style="margin-left:17%; margin-right:17%">ELYSIUM</a>
              <a href="../menu/menu.php" class="tit ms-3">Menu</a>
              <a href="../contactus/cont.php" class="tit ms-3">Contact us</a>
            </div>
          </div>
      </nav>

    </div>
    <main>
        <section id="about-me" class="about-section">
            <p class="cinzel-decorative-regular p-0 m-0" style="opacity:0.87">ABOUT US</p>
        </section>
    
    </main>
    </main>
        <section id="about">
            <div class="container">
                <div class="title">
                    <h2> Elysium love story </h2>
                    <p>More than 25+ years of experience</p>
                </div>
                <div class="about-content">
                    <div>
                        <p>Elysium in the heart of the city, our restaurant offers a delightful escape into a world of flavor and comfort. Guests are treated to a blend of modern culinary artistry and timeless recipes, crafted to perfection by our skilled chefs. Whether you're visiting Elysium.</p>
                        <br/>
                        <p>Step into an atmosphere where charm meets sophistication. The warm ambiance, coupled with impeccable service, makes every visit unforgettable. From fresh, locally sourced ingredients to innovative dishes.</p>
                        <a href="#" class="btn btn-secondary">LEARN MORE</a>
                    </div>
                    <img src="images/WhatsApp Image 2024-12-11 at 18.11.44_3e3f643f.jpg" alt="food">
                </div>
            </div>
        </section>
            <section id="our-gallery">
                <div class="container">
                    <div class="title">
                        <h2>OUR GALLERY</h2>
                        <p>Explore our beautiful food creations</p>
                    </div>
                    <div class="gallery">
                        <div class="gallery-item">
                            <img src="images/WhatsApp Image 2024-12-11 at 19.03.19_8c9d9eec.jpg" alt="Gallery Image 1">
                        </div>
                        <div class="gallery-item">
                            <img src="images/WhatsApp Image 2024-12-11 at 19.03.22_1c00bd1e.jpg" alt="Gallery Image 2">
                        </div>
                        <div class="gallery-item">
                            <img src="images/WhatsApp Image 2024-12-11 at 19.03.22_631c5f10.jpg" alt="Gallery Image 3">
                        </div>
                        <div class="gallery-item">
                            <img src="images/WhatsApp Image 2024-12-11 at 19.03.23_5fac4bc9.jpg" alt="Gallery Image 4">
                        </div>
                        <div class="gallery-item">
                            <img src="images/WhatsApp Image 2024-12-11 at 19.03.23_1be2eff7.jpg" alt="Gallery Image 5">
                        </div>
                        <div class="gallery-item">
                            <img src="images/WhatsApp Image 2024-12-11 at 19.08.45_6f9899e5.jpg" alt="Gallery Image 6">
                        </div>
                    </div>
                </div>
            </section>
            <section id="master-chef">
                <div class="container">
                    <h2>Master Chef</h2>
                    <div class="chef-cards">
                        <?php
                        // Database connection
                        $conn = mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");

                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Fetch chefs data
                        $query = "SELECT `chefname`, `specialty`, `chefimage` FROM `chefs`";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $chefname = $row['chefname'];
                                $specialty = $row['specialty'];
                                $chefimage = $row['chefimage'];
                                
                                echo "
                                <div class='card'>
                                    <img src='images/$chefimage' alt='$chefname'>
                                    <h3 class='card-title'>Chef $chefname</h3>
                                    <p>$specialty</p>
                                </div>";
                            }
                        } else {
                            echo "<p>No chefs found.</p>";
                        }

                        // Close the connection
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </section>
            
        </header>
        <footer>
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
     </main>
     
