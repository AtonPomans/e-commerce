
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

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
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image type
    $allowed_types = ['jpg', 'jpeg', 'png', 'webp'];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Only JPG, JPEG, PNG, and WEBP files are allowed.");
    }

    // Check for upload errors
    if ($_FILES["image"]["error"] !== 0) {
        die("Error uploading image.");
    }

    // Prepare and insert product into database
    $stmt = $conn->prepare("INSERT INTO products (name, price, description, image_path) VALUES (?, ?, ?, ?)");
    $image_path_db = "uploads/" . $filename; // Path saved in DB is relative to public
    $stmt->bind_param("sdss", $name, $price, $description, $image_path_db);

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
