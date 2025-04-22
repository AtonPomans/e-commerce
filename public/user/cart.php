
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';


$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT p.product_id, p.name, p.price, p.description, p.image_path, c.cart_id
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<body><main>

    <div class="container py-5">
        <h1 class="text-center mb-4">Your Cart</h1>
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td style="width: 80px;">
                        <img src="/assets/images/uploads/<?= htmlspecialchars($row['image_path']) ?>" alt="image" class="img-thumbnail" style="max-width: 70px;">
                    </td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td>$<?= number_format($row['price'], 2) ?></td>
                    <td class="text-muted small"><?= htmlspecialchars($row['description']) ?></td>
                    <td style="white-space: nowrap;">
                        <form method="post" action="/shop/remove_from_cart.php" class="d-inline">
                            <input type="hidden" name="cart_id" value="<?= $row['cart_id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Remove from Cart</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


</main></body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/footer.php'; ?>

