<?php
require_once "connection/link.php";
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
?>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/80480a3d8b.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <a href="index.php" ><img src="img\headlogo.png" alt="" class="logoh"></a>
    <!--Navigation bar-->
    <nav>
        <ul class="navigation">
            <li><a href="index.php"><i class="fas fa-home home"></i> Home</a></li>
            <li><a href="menu.php" class="active_link"><i class="fas fa-bacon bacon"></i> Menu</a></li>
            <li><a href="about.php"><i class="fas fa-align-left about"></i> About</a></li>
            <li><a href="delivery.php"><i class="fas fa-camera gallery"></i>Delivery</a></li>
            <li><a href="news.php"><i class="fas fa-users team"></i>News</a></li>
            <li><a href="reviews.php"><i class="fas fa-comments" aria-hidden="true" style="color: orangered"></i> Reviews</a></li>
            <?php
            if($_SESSION["user"] == "admin") {
                ?>
                <li><a href="admin-page.php"><i class="fas fa-user" aria-hidden="true" style="color: lightblue;"></i>Admin page</a></li>
            <?php } ?>
            <?php
            if(empty($_SESSION["user"])) {
                ?>
                <li><form action="login.php"><a href="login.php"><i class="fas fa-sign-in-alt login"></i>Login</a></form></li>
            <?php }else { ?>
                <li><form action="exit.php"><a href="exit.php">Logout<?php echo " (". $_COOKIE["username"] . ")" ?></a></form></li>
            <?php  } ?>
        </ul>
    </nav>
    <!--Logo of menu which will show up when the screen is reduced-->
    <i class="menu fas fa-bars"></i>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>
</header>

<?php
require_once "connection/link.php";
$query = "SELECT * FROM foods";
$result = mysqli_query($link, $query);
if ($result ===false){
    echo mysqli_error($link);
} else{
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<main>
    <div class="shadowed">
        <section class="menu-container menu-section" style="color:#F5A7BC;">
            <h2 class="menu-header">Menu</h2>
            <div class="menu-items">
                <?php foreach ($items as $item):?>
                    <div class="menu-item">
                        <span id="food_name" class="menu-item-title"><?= $item['food_name'] ?></span>
                        <a id="menu-item" href="<?= $item['menu_href'] ?>" ><img class="menu-item-image" src="<?= $item['food_image'] ?>"></a>
                        <div class="menu-item-details">
                            <label>Food cost: </label><p name="food_cost" class="menu-item-price"><?= $item['food_cost'] ?></p>
                            <label>Available count: </label><p name="food_count" class="menu-item-price"><?= $item['food_count'] ?></p>
                            <input class="button button-primary menu-item-button" type="submit" name="Add_cart" value="Add to cart">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="menu-container menu-section" style="background: #ffde59; border-radius:20px;">
            <h2 class="menu-header">CART</h2>
            <div class="cart-row">
                <span class="cart-item cart-header cart-column">ITEM</span>
                <span class="cart-price cart-header cart-column">PRICE</span>
                <span class="cart-quantity cart-header cart-column">QUANTITY</span>
            </div>
            <div class="cart-items">
            </div>
            <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">0</span>
            </div>
            <button class="button button-primary button-purchase" onclick="pay.php" type="button">PURCHASE</button>
        </section>
    </div>
</main>

<footer>
    <div class="foot">
        <div class="left-column">
            <img src="img\logo.png" alt="" class="logof">

            <div class="social_media">
                <a href="https://www.instagram.com/soul_ofel/?hl=ru" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.youtube.com/channel/UCHI2Oun-in7bdcEj-0s2P5Q?view_as=subscriber" target="_blank"><i class="fab fa-youtube"></i></a>
                <a href="https://vk.com/id138183721" target="_blank"><i class="fab fa-vk"></i></a>
            </div>


            <p class="foot_text">© 2020 Created By <a href="https://www.instagram.com/soul_ofel/?hl=ru" id="me">Kaiyrbekova Zhanel </a> All Rights Reserved.</p>
        </div>

        <div class="right-column">
            <h1 class="h1-r-col">Our Newsletter</h1>
            <div class="border"></div>
            <p class="border-text">Enter Your Email to get our news and updates.</p>
            <form action="" class="newsletter-form">
                <input type="text" class="mailing" placeholder="Enter Your Email">
                <input type="submit" class="submit_button" value="submit">
            </form>
        </div>
    </div>
</footer>

<script type="text/javascript" src="js\java.js"></script>
<script type="text/javascript" src="js\menu.js"></script>
</body>
</html>