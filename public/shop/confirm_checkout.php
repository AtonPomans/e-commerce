<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


// maybe TODO: save order history here in a new table

// get product_ids from cart
$product_query = $conn->query("SELECT product_id FROM cart WHERE user_id = $user_id");

while ($row = $product_query->fetch_assoc()) {
    $product_id = intval($row['product_id']);
    $product_details = $conn->query("SELECT name, price, description, image_path FROM products WHERE product_id = $product_id");

    if ($product = $product_details->fetch_assoc()) {
        $name = $product['name'];
        $price = $product['price'];
        $description = $product['description'];
        $image_path = $product['image_path'];

        $stmt = $conn->prepare("INSERT INTO order_history (user_id, name, price, description, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isdss", $user_id, $name, $price, $description, $image_path);

        if ($stmt->execute()) {
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

//




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

// maybe TODO: dont delete product
//             just remove from quantity if quantity is added


header("Location: /shop/checkout_success.php");
exit();
?>

