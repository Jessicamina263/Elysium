<?php
if (!isset($footer_type)) {
    $footer_type = 'default'; // Fallback to default if not set
}
?>
<footer class="<?php echo $footer_type; ?>">
    <div class="container">
        <div class="row">
            <div class="col" id="company">
                <div class="col" id="services">
                    <h3>Why to choose Elysium</h3>
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
    </div>
</footer>