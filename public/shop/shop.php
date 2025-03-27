
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

$sql = "SELECT name, price, description, image_path
        FROM products";
$result = $conn->query($sql);
?>

<body>
    <main>

<div class="container py-5">
    <h1 class="text-center mb-4">Shop</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                        <p class="card-text">$<?php echo number_format($row['price'], 2); ?></p>
                        <p class="card-text text-muted small"><?php echo htmlspecialchars($row['description']); ?></p>
                        <a href="#" class="btn btn-primary w-100">View Item</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!--
        <h1 class="text-center mt-4 mb-4">Shop</h1>

        <div class="container">

            <div class="m-4 justify-content-center row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="https://placehold.co/300x200" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">Vintage Camera</h5>
                            <p class="card-text">$120.00</p>
                            <p class="card-text text-muted small">A beautifully preserved vintage camera, perfect for collectors and enthusiasts.</p>
                            <a href="#" class="btn btn-primary w-100">View Item</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-4 justify-content-center row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="https://placehold.co/300x200" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">Vintage Camera</h5>
                            <p class="card-text">$120.00</p>
                            <p class="card-text text-muted small">A beautifully preserved vintage camera, perfect for collectors and enthusiasts.</p>
                            <a href="#" class="btn btn-primary w-100">View Item</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
-->



    </main>
</body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/footer.php'; ?>

