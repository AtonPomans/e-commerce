
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

    // Move file to uploads directory
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        die("Failed to save uploaded image.");
    }

    // Prepare and insert product into database
    $stmt = $conn->prepare("INSERT INTO products (name, price, description, image_path) VALUES (?, ?, ?, ?)");
    $image_path_db = "uploads/" . $filename; // Path saved in DB is relative to public
    $stmt->bind_param("sdss", $name, $price, $description, $image_path_db);

    if ($stmt->execute()) {
        echo "<p>Product listed successfully!</p>";
        echo '<p><a href="/shop/shop.php">Go to shop</a></p>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<body><main>

    <div class="container py-5" style="max-width: 600px;">
        <h2 class="text-center mb-4">List a New Product</h2>

        <form action="list-item.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" step="0.01" class="form-control" name="price" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Product Image</label>
                <input type="file" class="form-control" name="image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit Product</button>
        </form>
    </div>

</main></body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/footer.php'; ?>

</html>

