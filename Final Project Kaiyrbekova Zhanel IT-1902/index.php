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
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/80480a3d8b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<header>
    <a href="index.php"><img src="img\logo.png" alt="" class="logoh"></a>
    <!--Navigation bar-->
    <nav>
        <ul class="navigation">
            <li><a href="index.php" class="active_link"><i class="fas fa-home home"></i> Home</a></li>
            <li><a href="menu.php"><i class="fas fa-bacon bacon"></i> Menu</a></li>
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
    <!--Logo of the menu which will show up when the screen is reduced-->
    <i class="menu fas fa-bars"></i>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>
</header>

<main>
    <div class="index_page shadowed">
        <div class="greeting">
            <h1>Food with soul</h1>
        </div>

        <div class="columns">
            <h1>Our food made with love and soul </h1>
            <p>Tasty, satisfying and cooked with love and soul - this is the principle of our restaurant.</p>
            <p>If you are tired of fast food and convenience foods, as well as miss home-cooked food, our kitchen is perfect for you.</p>
        </div>

        <div class="columns">
            <a href=""><img src="img\index-food.jpg" id="food1"></a>
        </div>

        <div class="slideshow">

            <div class="mySlide fade">
                <div class="number">1 / 4</div>
                <img src="img\1.jpg" class="slide_photos">
            </div>

            <div class="mySlide fade">
                <div class="number">2 / 4</div>
                <img src="img\2.jpg" class="slide_photos">
            </div>

            <div class="mySlide fade">
                <div class="number">3 / 4</div>
                <img src="img\3.jpg" class="slide_photos">
            </div>

            <div class="mySlide fade">
                <div class="number">4 / 4</div>
                <img src="img\4.jpg" class="slide_photos">
            </div>

            <a class="prev" onclick="scrollSlide(-1)">&#10094;</a>
            <a class="next" onclick="scrollSlide(1)">&#10095;</a>

            <div style="text-align:center; margin: 10px 0;">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
            </div>

        </div>
    </div>
</main>

<<footer>
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
                <input type="submit" class="submit_button" value="Submit">
            </form>
        </div>
    </div>
</footer>
<script type="text/javascript" src="review.js"></script>
<script type="text/javascript" src="js\java.js"></script>
<script>
    var indexOfSlide = 1;
    displaySlides(indexOfSlide);
    function scrollSlide(n) {
        displaySlides(indexOfSlide += n);
    }

    function currentSlide(n) {
        displaySlides(indexOfSlide = n);
    }

    function displaySlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlide");
        var dot = document.getElementsByClassName("dot");
        if (n > slides.length) {indexOfSlide = 1}
        if (n < 1) {indexOfSlide = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dot.length; i++) {
            dot[i].className = dot[i].className.replace(" active", "");
        }
        slides[indexOfSlide-1].style.display = "block";
        dot[indexOfSlide-1].className += " active";
    }
</script>
</body>
</html>