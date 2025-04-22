
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

$user_id = $_SESSION['user_id'];

//Select information from users table to display on dashboard
$sql_users = "SELECT first_name, last_name
FROM users";
$result_users = $conn->query($sql_users);
$row_users = $result_users->fetch_assoc();

// get user's listings
$product_result = $conn->query("SELECT * FROM products WHERE user_id = $user_id");

//query might need to go here to pull information from user_address table
//I need to look at Amazon and Newegg to see how they format their user dashboards
?>

<body>
    <main>

        <div class="container-fluid bg-light py-5">
            <div class="m-auto text-left col-md-6">
                <h1 class="h1">User Dashboard</h1>
                <h4>User: </h4>
                <p>
                    <?php echo htmlspecialchars($row_users['first_name']); ?> <?php echo htmlspecialchars($row_users['last_name']); ?>
                </p>

            </div>
        </div>





        <!-- can keep at bottom of page. there's an anchor here so shop page can go directly here -->
        <div class="container" id="your-listings">
            <hr class="my-4">
            <h3 class="mb-3">Your Listings</h3>

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $product_result->fetch_assoc()): ?>
                    <tr>
                        <td style="width: 80px;">
                            <img src="/assets/images/uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="product" class="img-thumbnail" style="max-width: 70px;">
                        </td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td>$<?= number_format($product['price'], 2) ?></td>
                        <td class="text-muted small"><?= htmlspecialchars($product['description']) ?></td>
                        <td style="white-space: nowrap;">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editItemModal<?= $product['product_id'] ?>">
                                Edit
                            </button>
                            <form action="/user/remove_listing.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>


                    <?php
                    // query to populate category dropdown in the modal
                    $category_list = $conn->query("SELECT category_id, name FROM categories");
?>


                    <!-- edit listing modal -->
                    <div class="modal fade" id="editItemModal<?= $product['product_id'] ?>" tabindex="-1" aria-labelledby="editItemModalLabel<?= $product['product_id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/user/update_listing.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit <?= htmlspecialchars($product['name']) ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Name -->
                                        <div class="mb-3">
                                            <label class="form-label">Product Name</label>
                                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
                                        </div>

                                        <!-- Price -->
                                        <div class="mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" required>
                                        </div>

                                        <!-- Category -->
                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select name="category_id" class="form-control" required>
                                                <?php
                                                $categories = $conn->query("SELECT category_id, name FROM categories");
                                                while ($cat = $categories->fetch_assoc()):
                                                ?>
                                                <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id'] == $product['category_id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($cat['name']) ?>
                                                </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                                        </div>

                                        <!-- Image -->
                                        <div class="mb-3">
                                            <label class="form-label">Image Upload (optional)</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <!-- end of "Your Listings" section -->


    </main>
</body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/footer.php'; ?>

