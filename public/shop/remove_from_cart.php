<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']);

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Delete only if the cart item belongs to the logged-in user
    $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_id, $user_id);
    $stmt->execute();
}

header("Location: /user/cart.php");
exit();
?>

