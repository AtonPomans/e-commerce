
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';


$sql = "SELECT product_id, name, price, description, image_path
FROM products";
$result = $conn->query($sql);
?>

<!-- list item form status -->
<?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div class="container alert alert-success alert-dismissible fade show mt-3 w-25" role="alert">
        ✅ Your item was listed successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<body>
    <main>

        <!--<?php echo htmlspecialchars($row['image_path']); ?>-->

        <div class="container py-5">
            <h1 class="text-center mb-4">Shop</h1>

            <div class="d-flex justify-content-center my-4">
                <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#listItem">
                    List Item
                </button>
            </div>

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




        <!-- list item modal -->
        <div class="modal fade" id="listItem" tabindex="-1" aria-labelledby="listItemLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Modal Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="itemForm" action="list_item.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter product name" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" name="price" placeholder="Enter price" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="4" placeholder="Enter product description" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image Upload</label>
                                <input class="form-control" type="file" name="image" accept="image/*" required>
                            </div>
                        </form>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="itemForm">Save changes</button>
                    </div>

                </div>
            </div>
        </div>


    </main>
</body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/footer.php'; ?>

<script>
  setTimeout(() => {
    const alert = document.querySelector('.alert');
    if (alert) {
      const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
      bsAlert.close();
    }
  }, 8000); // hide after 4 seconds
</script>


