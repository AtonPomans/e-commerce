
<?php
session_start();
$loggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Site</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<nav class="navbar navbar-expand-lg bg-light nav-shadow">
    <div class="container">

        <div>
            <h1 class="text-primary">E-Commerce</h1>
        </div>

        <div class="d-flex ms-auto">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item nav-items"><a class="nav-link nav-links" href="/index.php">Home</a></li>
                        <li class="nav-item nav-items"><a class="nav-link nav-links" href="/shop/shop.php">Shop</a></li>
                        <li class="nav-item nav-items"><a class="nav-link nav-links" href="/contact/contact.php">Contact</a></li>
                    </ul>

                    <div>

                        <a href="#" class="text-decoration-none text-dark nav-icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                        <a href="/user/cart.php" class="text-decoration-none text-dark nav-icon">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>

                        <?php if ($loggedIn): ?>

                            <div class="dropdown d-inline-block nav-icon">
                                <a class="dropdown-toggle text-decoration-none text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/user/account.php">My Account</a><li>
                                    <li><a class="dropdown-item" href="/user/settings.php">Settings</a><li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/auth/logout.php">Logout</a><li>
                                </ul>
                            </div>

                        <?php else: ?>

                            <div class="dropdown d-inline-block nav-icon">
                                <a class="dropdown-toggle text-decoration-none text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/auth/login.php">Login</a><li>
                                    <li><a class="dropdown-item" href="/auth/register.php">Register</a><li>
                                </ul>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</nav>

