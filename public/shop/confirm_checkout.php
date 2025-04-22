<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// get product_ids from cart
$product_query = $conn->query("SELECT product_id FROM cart WHERE user_id = $user_id");

$product_ids = [];
while ($row = $product_query->fetch_assoc()) {
    $product_ids[] = intval($row['product_id']);
}

// delete each product
if (!empty($product_ids)) {
    $ids_string = implode(',', $product_ids);
    $conn->query("DELETE FROM products WHERE product_id IN ($ids_string)");
}

$conn->query("DELETE FROM cart WHERE user_id = $user_id");


// maybe TODO: save order history here in a new table
// maybe TODO: dont delete product
//             just remove from quantity of quantity is added


header("Location: /shop/checkout_success.php");
exit();
?>

