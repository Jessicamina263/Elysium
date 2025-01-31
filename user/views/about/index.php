<?php
$header_type = 'about'; // Custom header for about page
$footer_type = 'about'; // Custom footer for about page
?>
<!-- About page content -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/restaurant/user/public/assets/css/about.css">
        <title>ELYSIUM - About Page</title>
        <link rel="icon" type="image/x-icon" href="../assets/icons/eee (1).ico">
    </head>
<body>

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
                    <img src="/restaurant/user/public/assets/images/about/WhatsApp Image 2024-12-11 at 18.11.44_3e3f643f.jpg" alt="food">
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
                            <img src="/restaurant/user/public/assets/images/about/WhatsApp Image 2024-12-11 at 19.03.19_8c9d9eec.jpg" alt="Gallery Image 1">
                        </div>
                        <div class="gallery-item">
                            <img src="/restaurant/user/public/assets/images/about/WhatsApp Image 2024-12-11 at 19.03.22_1c00bd1e.jpg" alt="Gallery Image 2">
                        </div>
                        <div class="gallery-item">
                            <img src="/restaurant/user/public/assets/images/about/WhatsApp Image 2024-12-11 at 19.03.22_631c5f10.jpg" alt="Gallery Image 3">
                        </div>
                        <div class="gallery-item">
                            <img src="/restaurant/user/public/assets/images/about/WhatsApp Image 2024-12-11 at 19.03.23_5fac4bc9.jpg" alt="Gallery Image 4">
                        </div>
                        <div class="gallery-item">
                            <img src="/restaurant/user/public/assets/images/about/WhatsApp Image 2024-12-11 at 19.03.23_1be2eff7.jpg" alt="Gallery Image 5">
                        </div>
                        <div class="gallery-item">
                            <img src="/restaurant/user/public/assets/images/about/WhatsApp Image 2024-12-11 at 19.08.45_6f9899e5.jpg" alt="Gallery Image 6">
                        </div>
                    </div>
                </div>
            </section>
     </main>
    <?php
        include '/opt/lampp/htdocs/restaurant/user/views/about/chef.php';
    ?>
</body>
</html>