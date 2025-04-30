
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';


$products = $conn->query("SELECT name, image_path FROM products ORDER BY created_at ASC");
?>

<body>
    <main>

        <!-- Carousel Section -->
        <div id="productCarousel" class="carousel slide mx-auto mt-4" data-bs-ride="carousel" style="max-width: 75%; overflow: hidden">

            <div class="carousel-inner">
                <?php
                $active = true;
                while ($product = $products->fetch_assoc()):
                ?>
                <div class="carousel-item <?= $active ? 'active' : '' ?>">
                    <img src="/assets/images/uploads/<?= htmlspecialchars($product['image_path']) ?>" class="d-block carousel-img" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?= htmlspecialchars($product['name']) ?></h5>
                        <a href="/shop/shop.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <?php $active = false; ?>
                <?php endwhile; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </main>
</body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/footer.php'; ?>

