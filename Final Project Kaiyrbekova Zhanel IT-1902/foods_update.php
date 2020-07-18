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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/80480a3d8b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        body{
            text-decoration: none;
        }
    </style>
</head>
<body>

<header>
    <a href="index.php"><img src="img\logo.png" alt="" class="logoh"></a>
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
                <li><a href="admin-page.php" class="active_link"><i class="fas fa-user" aria-hidden="true" style="color: lightblue;"></i>Admin page</a></li>
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

<!-- Admin Page START -->
<div class="admin-wrapper">
    <div class="left-sidebar">
        <ul>
            <li><a href="admin-page.php">Manage News</a></li>
            <li><a href="foods_add.php">Manage Menu</a></li>
        </ul>
    </div>

    <div class="admin-content">
        <div class="button-group">
            <a href="foods_add.php" class="">Add Menu</a>
            <a href="foods_delete.php" class="">Delete Menu</a>
        </div>

        <div class="content">
            <!-- Admin-ADD START-->
            <h3 class="page-title">Add Food</h3>
            <form method="post">
                <div class="form-group">
                    <label for="food_name">Existing food name:</label>
                    <input name="food_name" id="food_name" placeholder="Food name...">
                </div>

                <div class="form-group">
                    <label for="food_image">Food image:</label>
                    <input name="food_image" id="food_image" placeholder="URL of food image...">
                </div>

                <div class="form-group">
                    <label for="food_cost">Food cost (KZT):</label>
                    <input type="number" name="food_cost" id="food_cost" placeholder="Food cost...">
                </div>

                <div class="form-group">
                    <label for="food_count">Count:</label>
                    <input type="number" name="food_count" id="food_count" placeholder="Count...">
                </div>

                <button class="">Update</button>
            </form>

            <?php
            require_once "connection/link.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST"){

                $food_name = $_POST['food_name'];
                $food_image = $_POST['food_image'];
                $food_cost = $_POST['food_cost'];
                $food_count = $_POST['food_count'];
                $menu_href = $_POST['menu_href'];
                if (empty($food_name) || empty($food_image) || empty($food_cost) || empty($food_count)) {
                    echo "<script type='text/javascript'>alert('All fields are required!')</script>";
                    return;
                }

                if (isset($_POST['food_image']) && isset($_POST['food_cost']) && isset($_POST['food_count'])){
                    $sql = "UPDATE foods SET food_image = '$_POST[food_image]', food_cost = '$_POST[food_cost]', food_count = '$_POST[food_count]'
                    WHERE food_name = '$_POST[food_name]' ";
                }

                if ($link->query($sql) === TRUE) {
                    echo "<script type='text/javascript'>alert('Food updated successfully');</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Error updating record: . $link->error');</script>";
                }

                $link->close();
            }
            ?>
            <!-- Admin-ADD END-->
        </div>
    </div>
</div>
<!-- Admin Page END -->
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