<?php

require_once "Database.php";

$conn = new Database("localhost", "root", "zhanel", "php final project");
$link = $conn->connect();