<?php
if (!isset($header_type)) {
    $header_type = 'default'; // Fallback to default if not set
}
?>
<div class="header <?php echo $header_type; ?>">
    <div class="d1 m-0 p-0">
        <nav class="row m-0" style="color: transparent; background-color:transparent">
            <div class="container-fluid my-1 row my-2 justify-content-center align-items-center ms-5">
                <div class="ps-5 pe-3" style="margin-left: 18%">
                    <a href="/restaurant/user/public/index.php?page=about" class="tit">About us</a>
                    <a href="/restaurant/user/public/index.php?page=reserve" class="tit ms-3">Reservation</a>
                    <a href="/restaurant/user/public/index.php?page=home" class="tit" style="margin-left:17%; margin-right:17%">ELYSIUM</a>
                    <a href="/restaurant/user/public/index.php?page=menu" class="tit ms-3">Menu</a>
                    <a href="/restaurant/user/public/index.php?page=contact" class="tit ms-3">Contact us</a>
                </div>
            </div>
        </nav>
    </div>
</div>