<section id="master-chef">
    <div class="container">
        <h2>Master Chef</h2>
        <div class="chef-cards">
            <?php
                // Database connection
                $conn = mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");

                // Check connection
                if (!$conn) 
                {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch chefs data
                $query = "SELECT `chefname`, `specialty`, `chefimage` FROM `chefs`";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) 
                {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        $chefname = $row['chefname'];
                        $specialty = $row['specialty'];
                        $chefimage = $row['chefimage'];
                                
                        echo "
                        <div class='card'>
                            <img src='/restaurant/user/public/assets/images/about/$chefimage' alt='$chefname'>
                            <h3 class='card-title'>Chef $chefname</h3>
                            <p>$specialty</p>
                        </div>";
                    }
                } 
                else 
                {
                    echo "<p>No chefs found.</p>";
                }

                // Close the connection
                mysqli_close($conn);
            ?>
        </div>
    </div>
</section>