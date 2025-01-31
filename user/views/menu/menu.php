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
                                    echo '<div class="carousel-item' . ($isActive ? ' active' : '') . '" style="z-index: 6000;width: 80%;margin-left: 12%">';
                                    echo '<div class="row w-100 justify-content-center">';
                                    
                                    foreach ($chunk as $row) {
                                        $imagePath = "/restaurant/user/public/assets/images/menu/" . htmlspecialchars($row['prodtype']) . "/" . htmlspecialchars($row['prodimage']);
                                        $imagealt = htmlspecialchars($row['prodimage']);
                                        echo '<div class="col-3" data-prodtype="' . htmlspecialchars($row['prodtype']) . '" data-prodname="' . htmlspecialchars($row['prodname']) . '" data-prodprice="' . htmlspecialchars($row['prodprice']) . '" data-proddesc="' . htmlspecialchars($row['proddesc']) . '" data-prodimage="' . htmlspecialchars($row['prodimage']) . '" data-chefname="' . htmlspecialchars($row['chefname']) . '" data-prodrate="' . htmlspecialchars($row['prodrate']) . '">';
                                        echo "
                                            <div class='card text-center'>
                                                <img src='$imagePath' class='card-img-top' alt='$imagealt' style='height: 200px; object-fit: cover; opacity: 0.95;'>
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