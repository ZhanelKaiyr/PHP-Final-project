<?php
require_once "connection/link.php";
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
?>

<?php
session_start();
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/80480a3d8b.js" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
</head>
<body>

<header>
    <a href="index.php" ><img src="img\logo.png" alt="" class="logoh"></a>

    <!--Navigation bar-->
    <nav>
        <ul class="navigation">
            <li><a href="index.php"><i class="fas fa-home home"></i> Home</a></li>
            <li><a href="menu.php"><i class="fas fa-bacon bacon"></i> Menu</a></li>
            <li><a href="about.php"><i class="fas fa-align-left about"></i> About</a></li>
            <li><a href="delivery.php"><i class="fas fa-camera gallery"></i>Delivery</a></li>
            <li><a href="news.php"><i class="fas fa-users team"></i>News</a></li>
            <li><a href="login.php" class="active_link"><i class="fas fa-sign-in-alt login"></i> Login</a></li>
        </ul>
    </nav>
    <!--Logo of menu which will show up when the screen is reduced-->
    <i class="menu fas fa-bars"></i>
    <div class="progress-container">
        <div class="progress-bar" id="myBar"></div>
    </div>
</header>

<main>
    <div class="shadowed login-content">
        <div class="form-box">
            <div class="login-icons">
                <h3>Payment form</h3>
            </div>
            <form action="pay.php" class="content-input-form" method="post">
                <label for="card_name">Card owner's fullname:</label>
                <input type="text" name="card_name" id="card_name" required><br><br>
                <label for="card_number">Card number:</label>
                <input type="text" name="card_number" id="card_number" maxlength="16" required><br><br>
                <label for="exp_year">Exp year:</label>
                <input type="text" name="exp_year" id="exp_year" maxlength="4" required><br><br>
                <label for="exp_month">Exp month:</label>
                <input type="text" name="exp_month" id="exp_month" maxlength="2" required><br><br>
                <label for="cvv">CVV:</label>
                <input type="text" name="cvv" id="cvv" maxlength="3" required><br><br>

                <input type="submit" class="submit_button" name="pay" value="Pay">

            </form>
            <?php
            include_once 'connection/link.php';
            if(!((empty($_POST['card_name']) && empty($_POST['card_number']) && empty($_POST['exp_year']) && empty($_POST['exp_month']) && empty($_POST['cvv'])))){
                $sql = mysqli_query($link,"UPDATE orders
                        SET paid = '1'
                        WHERE username = '$user'");
                if($sql){
                    $select = mysqli_query($link, "SELECT food_name FROM orders WHERE username = '$user' ");
                    $result = $conn->query($select);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $food_name = $row['food_name'];
                        }
                    }
                    echo "<script>alert('Thank you for your purchase! Wait for a delivery :)')</script>";
                    $update = mysqli_query($link, "UPDATE foods SET food_count = food_count - 1 WHERE food_name = '$food_name' ");
                }
                mysqli_close($link);
            }
            ?>
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
            <form metod="" class="newsletter-form" action="">
                <input type="text" class="mailing" placeholder="Enter Your Email">
                <input type="submit" class="submit_button" value="submit">
            </form>
        </div>
    </div>
</footer>

</body>
</html>