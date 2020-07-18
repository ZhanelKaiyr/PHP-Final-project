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
    <title>Register</title>
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
            <li><a href="reviews.php"><i class="fas fa-comments" aria-hidden="true" style="color: orangered"></i> Reviews</a></li>
            <?php
            if($_SESSION["user"] == "admin") {
                ?>
                <li><a href="admin-page.php"><i class="fas fa-user" aria-hidden="true" style="color: lightblue;"></i>Admin page</a></li>
            <?php } ?>
            <?php
            if(empty($_SESSION["user"])) {
                ?>
                <li><form action="login.php"><a href="login.php" class="active_link"><i class="fas fa-sign-in-alt login"></i>Login</a></form></li>
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
    <div class="shadowed login-content">
        <div class="form-box">
            <div class="button-box">
                <div id="login-button"></div>
                <button type="submit" class="login-button" onclick="login()">Login</button>
                <button type="button" class="login-button" onclick="register()">Register</button>
            </div>

            <div class="login-icons">
                <a href="#"><img src="img\fb.png"></a>
                <a href="#"><img src="img\tw.png"></a>
                <a href="#"><img src="img\gp.png"></a>
            </div>
            <form method="post" id="register" class="content-input-form" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <input type="text" name="username" id="username" class="input-field" placeholder="Username" required>
                <input type="email" name="email" id="email" class="input-field" placeholder="Email" required>
                <input type="password" name="password" id="password" class="input-field" placeholder="Enter password" required>
                <input type="password" name="password2" id="password2" class="input-field" placeholder="Enter password again" required>
                <input type="text" name="fname" id="name" class="input-field" placeholder="Name" required>
                <input type="text" name="lname" id="surname" class="input-field" placeholder="Surname" required>
                <input type="date" name="birthday" id="birthday" class="input-field" placeholder="Birthday" required>
                <input type="number" name="phone_number" id="phone" class="input-field" placeholder="Phone Number" required>
                <input type="text" name="address" id="address" class="input-field" placeholder="Address"><br>
                <input type="submit" name="Submit" class="login-submit-button" id="register-button" value="Register">
            </form>

            <?php
            require_once "connection/link.php";
            function checkFname($fname)
            {
                if (is_numeric($fname)) {
                    throw new Exception("Your name must contain ONLY letters!");
                } else {
                    return true;
                }
            }

            function checkLname($lname)
            {
                if (is_numeric($lname)) {
                    throw new Exception("Surname must contain ONLY letters!");
                } else {
                    return true;
                }
            }

            if(isset($_POST['Submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $password2 = $_POST['password2'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $birthday = $_POST['birthday'];
                $phone_number = $_POST['phone_number'];
                $address = $_POST['address'];

                $sql = "SELECT * FROM users WHERE username='$username'";
                $result = mysqli_query($link, $sql);

                if(mysqli_num_rows($result) == 1){
                    echo '<script language="javascript">';
                    echo 'alert("This username already exists!")';
                    echo '</script>';
                }
                else{
                    if($password != $password2){
                        echo '<script language="javascript">';
                        echo 'alert("Passwords must be the same!")';
                        echo '</script>';
                    }else{
                        try {
                            checkFname($fname);
                            checkLname($lname);
                            $reg = "INSERT INTO users(fname, lname, birthday, email, username, password, address, phone_number) 
                            VALUES ('$fname', '$lname', '$birthday', '$email', '$username', '$password', '$address', '$phone_number')";
                            mysqli_query($link, $reg);
                            echo '<script language="javascript">';
                            echo 'alert("You are registered successfully!")';
                            echo '</script>';
                        } catch (Exception $e) {
                            echo '<script language="javascript">';
                            echo 'alert("Something went wrong :(")';
                            echo '</script>';
                            echo "Message: " . $e->getMessage() . "<br>";
                        }

                    }
                }
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
            <form action="" class="newsletter-form" action="">
                <input type="text" class="mailing" placeholder="Enter Your Email">
                <input type="submit" class="submit_button" value="submit">
            </form>
        </div>

    </div>
</footer>
<script type="text/javascript" src="js\java.js"></script>
<script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("login-button");

    function register(){
        window.location = "register.php";
    }

    function login(){
        window.location = "login.php";
    }
</script>
</body>
</html>
