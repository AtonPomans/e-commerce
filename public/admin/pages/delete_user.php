<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["user_id"])) {
    $user_id = $_POST['user_id'];
    echo $user_id;


    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
}

header("Location: ./users.php");
exit();


?>