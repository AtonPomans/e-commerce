
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // fetch product from the db
    $stmt = $conn->prepare("SELECT product_id, name, price
                            FROM products
                            WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        $item = [
            "id" => $product['product_id'],
            "name" => $product['name'],
            "price" => $product['price']
        ];

        // add to session cart
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['id'] === $item['id']) {
                $found = true;
                break;
            }
        }

        $_SESSION['cart'][] = $item;
    }

    header("Location: /user/cart.php");
    exit();
}
?>

