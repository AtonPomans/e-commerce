<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // Make sure user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Check if item is already in the cart
    $checkStmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $checkStmt->bind_param("ii", $user_id, $product_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows === 0) {
        // Insert into cart table
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
    }

    header("Location: /user/cart.php");
    exit();
}
?>

