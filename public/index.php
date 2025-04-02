
<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php'; ?>

<body>
    <main>

        <!-- Carousel Section -->
        <div id="productCarousel" class="carousel slide mx-auto mt-4" data-bs-ride="carousel" style="max-width: 75%; overflow: hidden">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img src="/assets/images/uploads/.placeholder.png" class="d-block w-100" alt="Product 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Featured Product 1</h5>
                        <a href="/shop/shop.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="/assets/images/uploads/.placeholder.png" class="d-block w-100" alt="Product 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Featured Product 2</h5>
                        <a href="/shop/shop.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="/assets/images/uploads/.placeholder.png" class="d-block w-100" alt="Product 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Featured Product 3</h5>
                        <a href="/shop/shop.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>

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

