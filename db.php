<?php
    $servername = "sql3.freesqldatabase.com";
    $username = "sql3766137";
    $password = "aLjTI6rH5A";
    $database = "sql3766137";

    $con = mysqli_connect("$servername","$username","$password","$database");

    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
