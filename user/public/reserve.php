<?php

    if (isset($_POST['reserve']))
    {
        $conn = mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $people = $_POST['people'];
        $date = $_POST['date'];
        $time = $_POST['time'];

        $sql = "INSERT INTO reservations (name, email, phone, people, date, time) VALUES ('$name', '$email', '$phone', '$people', '$date', '$time')";

        if ($conn->query($sql) === TRUE) 
        {
            echo "<script>alert('Reservation added successfully.'); window.location.href = ''; </script>";
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/reserve.css">
    <title>ELYSIUM - Reservation Page</title>
    <link rel="icon" type="image/x-icon" href="../assets/icons/eee (1).ico">
</head>
<body>
    <nav class="row m-0" style="color: transparent; background-color:transparent">
        <div class="container-fluid  my-1 row  my-2 justify-content-center align-items-center ms-5">
            <div class=" ps-5 pe-3" style="margin-left: 18%">
                <a href="./about.php" class="tit">About us</a>
                <a href="#" class="tit ms-3">Reservation</a>
                <a href="./home.php" class="tit" style="margin-left:17%; margin-right:17%">ELYSIUM</a>
                <a href="./menu.php" class="tit ms-3">Menu</a>
                <a href="./cont.php" class="tit ms-3">Contact us</a>
            </div>
        </div>
    </nav>

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
        <form  action="" method="post" enctype="multipart/form-data">
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
                <div class="col-md-4"><img src="../assets/images/reserve/food7.jpg" class="img-fluid gallery-img" alt="Image 1"></div>
                <div class="col-md-4"><img src="../assets/images/reserve/food8.jpg" class="img-fluid gallery-img" alt="Image 2"></div>
                <div class="col-md-4"><img src="../assets/images/reserve/food5.jpg" class="img-fluid gallery-img" alt="Image 3"></div>
                <div class="col-md-4"><img src="../assets/images/reserve/food4.jpg" class="img-fluid gallery-img" alt="Image 4"></div>
                <div class="col-md-4"><img src="../assets/images/reserve/food9.jpg" class="img-fluid gallery-img" alt="Image 5"></div>
                <div class="col-md-4"><img src="../assets/images/reserve/food6.jpg" class="img-fluid gallery-img" alt="Image 6"></div>
            </div>
        </div>
    </section>

    
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>