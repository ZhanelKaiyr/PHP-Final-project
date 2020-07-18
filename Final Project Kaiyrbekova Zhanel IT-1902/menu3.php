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
    <a href="index.php" ><img src="img\logo.png" alt="" class="logoh"></a>

    <!--Navigation bar-->
    <nav>
        <ul class="navigation">
            <li><a href="index.php"><i class="fas fa-home home"></i> Home</a></li>
            <li><a href="menu.php" class="active_link"><i class="fas fa-bacon bacon"></i> Menu</a></li>
            <li><a href="about.php"><i class="fas fa-align-left about"></i> About</a></li>
            <li><a href="delivery.php"><i class="fas fa-camera gallery"></i> Delivery</a></li>
            <li><a href="news.php"><i class="fas fa-users team"></i> News</a></li>
            <li><a href="login.php"><i class="fas fa-sign-in-alt login"></i> Login</a></li>
        </ul>

    </nav>
    <!--Logo of menu which will show up when the screen is reduced-->
    <i class="menu fas fa-bars"></i>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>
</header>

<main>
    <div class="shadowed">
        <section class="menu-container menu-section" style="color:#F5A7BC;">
            <h2 class="menu-header">Menu</h2>
            <div class="menu-items">
                <div>
                    <img src="img\menu-3.jpg" alt="" width="100%">
                </div>
                <div>
                    <?php
                    include 'main.php';
                    class menu3 extends main{

                        public function information(){
                            print 'Not only meat is suitable for the filling, but also poultry and any kinds of vegetables, and even cottage cheese and dried fruits. Manti is often flavored with a wide variety of spices, giving them a unique aroma and taste. Only the cooking method is common. Manty is steamed in special pots - cascans.';
                            print '<br>';
                        }
                    }

                    $menu3 = new menu3("Manti with meat",900,"beef, dough, onions, potatoes");

                    $menu3->information();

                    ?>

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
            <form action="" class="newsletter-form">
                <input type="text" class="mailing" placeholder="Enter Your Email">
                <input type="submit" class="submit_button" value="submit">
            </form>
        </div>
    </div>
</footer>
</body>
</html>

