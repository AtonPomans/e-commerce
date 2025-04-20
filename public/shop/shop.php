
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';


$search = $_GET['search'] ?? '';
$category_id = $_GET['category'] ?? '';

$sql = "SELECT product_id, name, price, description, image_path FROM products WHERE 1=1";

if (!empty($search)) {
    $safe_search = $conn->real_escape_string($search);
    $sql .= " AND name LIKE '%$safe_search%'";
}

if (!empty($category_id)) {
    $sql .= " AND category_id = " . intval($category_id);
}

$result = $conn->query($sql);

// Fetch categories again for the form (because the previous fetch loop used up the result)
$category_list = $conn->query("SELECT category_id, name FROM categories");
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

            <form method="GET" class="row g-2 mb-4 justify-content-center">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search products..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">All Categories</option>
                        <?php while ($cat = $category_list->fetch_assoc()): ?>
                        <option value="<?= $cat['category_id'] ?>" <?= (isset($_GET['category']) && $_GET['category'] == $cat['category_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">Search</button>
                </div>
            </form>


            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-lg-4 g-4">
                <?php while($row = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="/assets/images/uploads/<?php echo htmlspecialchars($row['image_path']); ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h4>
                            <p class="card-text">$<?php echo number_format($row['price'], 2); ?></p>
                            <p class="card-text description text-muted small"><?php echo htmlspecialchars($row['description']); ?></p>
                            <form action="add_to_cart.php" method="POST">
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
                        <h5 class="modal-title" id="myModalLabel">List Item</h5>
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
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" disabled selected>Select a category</option>
                                    <?php while ($row = $category_list->fetch_assoc()): ?>
                                        <option value="<?= $row['category_id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                                    <?php endwhile; ?>
                                </select>
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

                    <div class="modal-footer d-flex">
                        <button type="submit" class="btn btn-primary" form="itemForm">Post</button>
                        <button type="button" class="btn btn-secondary ms-auto" data-bs-dismiss="modal">Close</button>
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
  }, 8000); // hide after 8 seconds
</script>


