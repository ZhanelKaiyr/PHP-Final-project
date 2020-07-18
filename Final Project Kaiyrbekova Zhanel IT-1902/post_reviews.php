<?php
require_once "connection/link.php";

if(isset($_POST['user_email']) && isset($_POST['user_review'])) {
    $email = $_POST['user_email'];
    $review = $_POST['user_review'];
    $user = $_COOKIE['username'];

    $sql = "INSERT INTO news (title, url, content, published_at) VALUES (?, ?, ?, ?)";

    $stmt = $link->prepare($sql);
    $stmt->bind_param("ssss", $user, $email, $review, CURRENT_TIMESTAMP);
    $results = $stmt->execute();

    $id = mysqli_insert_id($link);
    if ($results === false){
        echo $stmt->error;
    } else {
        $id = $stmt->insert_id;
        echo "<script type='text/javascript'>alert('Inserted new with ID: $id')</script>";
    }

    $stmt->close();
}
