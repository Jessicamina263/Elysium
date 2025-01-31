<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ELYSIUM - Contact Page</title>
      <!-- for icons -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
      <!-- for font family -->
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+AU+TAS+Guides&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Charmonman:wght@400;700&family=Cinzel+Decorative:wght@400;700;900&family=Italianno&family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+AU+TAS+Guides&display=swap" rel="stylesheet">
      <link rel="icon" type="image/x-icon" href="../assets/icons/eee (1).ico">
      <link rel="stylesheet" href="/restaurant/user/public/assets/css/cont.css">
  </head>
  <body>
    <div class="image-section">
      <div class="text-overlay">
          Contact Us
      </div>
    </div>

    <div class="box-section d-flex justify-content-center align-items-center row">
    <div class="col-5 p-5 h-100 d-flex justify-content-center align-items-center">
    <div class="img">
    </div>
    </div>   
      <div class="boxes-container col-6 p-5 justify-content-center align-items-center column">
        <h2 >Get in Touch</h2>
        <p>
          We’d love to hear from you! Whether you have a question, feedback, or just want to say hello
        </p>
        <br>
        <div class="inner-box">
            <i class="fa-solid fa-map-location-dot" style=" font-size: 30px;"  ></i>
          <h3>
            Main Location
          </h3>
          
          <p>FF-42, Procube Avenue, <br> NY, USA</p>
        </div>
        
        <div class="inner-box">
            <i class="fa-solid fa-envelope"style=" font-size: 30px;" ></i>
            <h3>
              Email Address
            </h3>
            
            <p>
              elysium@gmail.com 
            </p>
          
          
          </div>
          <div class="inner-box">
            <i class="fa-solid fa-headphones"style=" font-size: 30px;" ></i>
            <h3>
              Phone Number
            </h3>
            
            <p>+1-8755856858</p>
          </div>
      </div>
    </div>
    <div style="background-color: #10231b; margin: 0%;" class="d-flex justify-content-center align-items-center">
      <form action ="/restaurant/user/views/contact/contact.php" method="POST" style="margin-bottom: 3%">
                <h2 ><b>Contact Us</b></h2>
                <br><br>
                <label for="name">Name</label>
                <input type="text" id="name" name="name"placeholder="Enter your full name" required>
        
                <label for="email">Email</label>
                <input type="email" id="email" name="email"placeholder="Enter your email" required>
        
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                <br><br>
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
                <br><br>
                <button type="submit"name="submit">Submit</button>
            </form>
          </div>
    <div class="image-container">
      <img src="/restaurant/user/public/assets/images/contact/A steak and a glass of red wine are on a table_ _ Premium AI-generated image.jpeg"  alt="image 1">
      <img src="/restaurant/user/public/assets/images/contact/3a7ab5107124863.5fa01a6ce358e.jpg" alt="image 2">
      <img src="/restaurant/user/public/assets/images/contact/download (1).jpeg"alt="image 3" >
      <img src="/restaurant/user/public/assets/images/contact/download.jpeg" alt="image 4" >
    </div>
    <?php
      include '/opt/lampp/htdocs/restaurant/user/views/contact/contact.php';
    ?>
  </body>
</html>