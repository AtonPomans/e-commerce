<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$cart_result = $conn->query("SELECT c.cart_id, p.name, p.price FROM cart c JOIN products p ON c.product_id = p.product_id WHERE c.user_id = $user_id");

$total = 0;
$items = [];

while ($row = $cart_result->fetch_assoc()) {
    $total += $row['price'];
    $items[] = $row;
}
?>

<main class="container my-5">
    <h1 class="mb-4">Checkout</h1>

    <?php if (empty($items)): ?>
    <p>Your cart is empty.</p>
    <?php else: ?>
    <ul class="list-group mb-3">
        <?php foreach ($items as $item): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= htmlspecialchars($item['name']) ?>
            <span>$<?= number_format($item['price'], 2) ?></span>
        </li>
        <?php endforeach; ?>
        <li class="list-group-item d-flex justify-content-between fw-bold">
            Total
            <span>$<?= number_format($total, 2) ?></span>
        </li>
    </ul>

    <form action="confirm_checkout.php" method="post">
        <button type="submit" class="btn btn-primary">Confirm Purchase</button>
    </form>
    <?php endif; ?>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/footer.php'; ?>

