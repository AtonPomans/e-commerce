<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["product_id"])){
    $prod_id = $_POST['product_id'];
    echo $prod_id;


    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("s", $prod_id);
    $stmt->execute();
}

header("Location: ./listings.php");
exit();


?>