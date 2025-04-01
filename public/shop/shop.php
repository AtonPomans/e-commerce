
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

$sql = "SELECT product_id, name, price, description, image_path
        FROM products";
$result = $conn->query($sql);
?>

<body>
    <main>

<!--<?php echo htmlspecialchars($row['image_path']); ?>-->

        <div class="container py-5">
            <h1 class="text-center mb-4">Shop</h1>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-lg-4 g-4">
                <?php while($row = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="https://placehold.co/300x200" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h4>
                            <p class="card-text">$<?php echo number_format($row['price'], 2); ?></p>
                            <p class="card-text text-muted small"><?php echo htmlspecialchars($row['description']); ?></p>
                            <form action="#" method="POST">
                                <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                                <button type="submit" class="btn btn-primary w-50">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>


    </main>
</body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/footer.php'; ?>

