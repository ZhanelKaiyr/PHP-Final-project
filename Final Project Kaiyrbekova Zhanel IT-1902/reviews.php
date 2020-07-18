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
    <title>Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/80480a3d8b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function post() {
            var email = document.getElementById("email").value;
            var review = document.getElementById("review").value;
            if(email && review)
            {
                $.ajax
                ({
                    type: 'post',
                    url: 'post_reviews.php',
                    data:
                        {
                            user_email: email,
                            user_review: review
                        },
                    success: function (response)
                    {
                        alert("Thank you for your review!");
                    }
                });
            }
            return false;
        }
    </script>
    <style>
        body {

            flex-wrap: wrap;
        }

        html {
            color: #ffde59;

            box-sizing: border-box;
            text-decoration: none;
            font-family: "kollektif",sans-serif,cursive ;
        }


        *, *:before, *:after {
            box-sizing: inherit;
        }

        .review-form {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3);
            width 700px;
            margin: 8px;
            color: #ffde59;
        }

        input[type=text], textarea {
            width: 680px;
            padding: 12px;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
            color: #ffde59;

        }

        .review_button{
            padding: 18px 40px;
            font-size: 16px;
            color: white;
            background:  #F5A7BC;
            border: none;
            font-weight: 700;
            outline: none;
            border-radius: 30px;
            margin: 0 auto;
            cursor: pointer;
            transition: .2s;
            max-width: 200px;
            text-align: center;
        }

        .review_button:hover{
            box-shadow:0 0 10px #F5A7BC, 0 0 20px #F5A7BC, 0 0 30px #F5A7BC;
            text-shadow: 0px 0px 1px #ffde59;
        }

        #all_reviews{
            overflow: scroll;
            height: 200px;
            width:680px;
        }
        .shadowed
        {
            width: 100%;
        }

        .news-content{
            height: 100%;
            padding: 15px;
            justify-content: center;
            align-items: center;

        }
    </style>
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
            <li><a href="reviews.php" class="active_link"><i class="fas fa-comments" aria-hidden="true" style="color: orangered"></i> Reviews</a></li>
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
    <div class="shadowed">
        <div class="news-content">
            <h1>Reviews from clients</h1>
            <div class="review-form">
                <form action="" method="post">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Your email..."><br>
                    <label for="review">Review:</label>
                    <textarea name="review" id="review" placeholder="Write your review..." style="height:170px"></textarea>
                    <input type="submit" value="Submit" onsubmit="return post();" class="review_button">
                </form>
            </div>
            <hr>
            <div id="all_reviews">
                <h3>Comments of users:</h3>
                <?php
                require_once "connection/link.php";

                $comm = mysqli_query($link,"select * from reviews");
                while($row=mysqli_fetch_array($comm))
                {
                    $username = $row['username'];
                    $email = $row['email'];
                    $review = $row['review'];
                    $time = $row['published_at'];
                    echo "<span style='text-align: right;'>".$time."</span>";
                    echo "<p><b>Written by: </b>".$username."</p>";
                    echo "<p><b>Email: </b>".$email."</p>";
                    echo "<p><b>Review: </b>".$review."</p>";
                    echo "<hr>";
                }
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

<script type="text/javascript" src="js\java.js"></script>

</body>
</html>