
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: /auth/login.php");
}

// form submition to handle item post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // validate form data
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);

    if (!$name || !$price || !$description || !isset($_FILES['image'])) {
        die("Missing required fields.");
    }

    //handle image uploads
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/assets/images/uploads/";
    $filename = uniqid() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $filename;

    // Validate image type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Only JPG, JPEG, PNG, and WEBP files are allowed.");
    }

    // Check for upload errors
    if ($_FILES["image"]["error"] !== 0) {
        die("Error uploading image.");
    }

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        die("Failed to move uploaded image file.");
    }

    // Prepare and insert product into database
    $stmt = $conn->prepare("INSERT INTO products (name, price, description, image_path, user_id) VALUES (?, ?, ?, ?, ?)");
    $image_path_db = $filename; // name of image. placed in /assets/images/uploads
    $stmt->bind_param("sdssi", $name, $price, $description, $image_path_db, $user_id);

    if ($stmt->execute()) {
        header("Location: /shop/shop.php?status=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
