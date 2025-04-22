
<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $product_id = intval($_POST['product_id']);
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $category_id = intval($_POST['category_id']);
    $description = trim($_POST['description']);

    // Check if product belongs to this user
    $stmt = $conn->prepare("SELECT image_path FROM products WHERE product_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $product_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        header("Location: /user/account.php?error=notfound");
        exit();
    }

    $new_image_path = $product['image_path'];

    // Handle image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/uploads/';
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $target_path = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            $new_image_path = $filename;
        }
    }

    // Update the listing
    $update_stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, category_id = ?, description = ?, image_path = ? WHERE product_id = ? AND user_id = ?");
    $update_stmt->bind_param("sdsssii", $name, $price, $category_id, $description, $new_image_path, $product_id, $user_id);
    $update_stmt->execute();
}

header("Location: /user/account.php?status=updated");
exit();
?>

