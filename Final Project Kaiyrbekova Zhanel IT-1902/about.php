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
    <title>About</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/80480a3d8b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
</head>
<body>
<header>
    <a href="index.php" ><img src="img\logo.png" alt="" class="logoh"></a>
    <!--Navigation bar-->
    <nav>
        <ul class="navigation">
            <li><a href="index.php"><i class="fas fa-home home"></i> Home</a></li>
            <li><a href="menu.php"><i class="fas fa-bacon bacon"></i> Menu</a></li>
            <li><a href="about.php" class="active_link"><i class="fas fa-align-left about"></i> About</a></li>
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

<main>
    <div class="about-content shadowed">

        <div class="cont">
            <div class="cont-img">
                <img class="img" src="img\logo.png" alt="">
            </div>
            <div class="motivators">
                <h2>Our motivators to cook the best food sre our clients.</h2>
            </div>
        </div>

        <div class="tabs">

            <div class="tabs-header">
                <div class="tab-h active-border" data-tab = "0">About us</div>
                <div class="tab-h" data-tab = "1">History</div>
                <div class="tab-h" data-tab = "2">Values</div>
            </div>
            <div class="tabs-body">
                <div class="tab-b" style="display: block;">
                    <Ol>
                        <ul>If you are tired of fast food and convenience foods, as well as miss home-cooked food, our kitchen is perfect for you.</ul>
                        <ul>Our kitchen is different in that the taste is the same as in childhood and does not differ from home cooking. We all know that our grandmothers and mothers do not have a secret ingredient, and what makes our dishes so delicious is love. Our voluminous menu includes not only everyone’s favorite homemade dishes, but also pizza, delicious desserts, hot dishes, but and delicious soups, a variety of salads and signature drinks! All this can be ordered with fast delivery from 40 minutes.</ul>
                    </Ol>
                </div>
                <div class="tab-b">
                    <ol>
                        <ul>The restaurants were created after student's life in dormitory. All the inspiration was taken from home-made food and family's love. The restaurant was opened in 2020.</ul>
                    </ol>

                </div>
                <div class="tab-b">
                    <ol>
                        <li>It has to be made with love.</li>
                        <li>Quality of the food.</li>
                        <li>The food should be not only tasty, but it has to look tasty.</li>
                        <li>The food should be served on a high level.</li>
                    </ol>
                </div>
            </div>

        </div>

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
            <form method="get" action="../Project/newsletter.php" class="newsletter-form"  >
                <input type="text" class="mailing" placeholder="Enter Your Email">
                <input type="button" class="submit_button" value="submit">
            </form>
        </div>
    </div>
</footer>

<script type="text/javascript" src="js\java.js"></script>
<script>
    window.onload = function(){
        document.querySelector('.tabs-header').addEventListener('click', fTabs);

        function fTabs(event){
            console.log(event);
            if(event.target.className == 'tab-h'){
                var dataTab = event.target.getAttribute('data-tab');

                var tabH = document.getElementsByClassName('tab-h');
                for( var i = 0; i<tabH.length; i++){
                    tabH[i].classList.remove('active-border');
                }
                event.target.classList.add('active-border');
                var tabBody = document.getElementsByClassName('tab-b');
                for( var i = 0; i<tabBody.length; i++){
                    if(dataTab == i)
                    {
                        tabBody[i].style.display = 'block';
                    }
                    else {
                        tabBody[i].style.display = 'none';
                    }
                }
            }
        }
    }
</script>
</body>
</html>