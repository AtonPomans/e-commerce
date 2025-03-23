<?php
    $host = "ecommerce.c4xw6gema9h1.us-east-1.rds.amazonaws.com";
    $user = "admin";
    $password = "db.Tr33P0st";
    $dbname = "ecommerce";

    $con = mysqli_connect("$host","$user","$password","$dbname");

    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
