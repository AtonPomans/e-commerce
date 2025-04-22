
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);

    // delete iff this product belongs to the logged-in user
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $product_id, $user_id);
    $stmt->execute();
}

header("Location: /user/account.php");
exit();
?>

