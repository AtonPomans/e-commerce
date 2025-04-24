<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["user_id"])) {
    $prod_id = $_POST['user_id'];
    echo $prod_id;


    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $prod_id);
    $stmt->execute();
}

header("Location: ./users.php");
exit();


?>