<?php
    session_start();
    $loggedIn = isset($_SESSION['admin_id']);
    include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>Current Transactions</title>

    <style>
        table, th, td {
            border: 3px solid black;
            border-collapse: collapse;
            background-color: lightgray;
        }

        html {
            background-color: gray;
        }
    </style>
</head>

<body>
    <?php if ($loggedIn): ?>
        <h1>Current Transactions</h1>

        <p>
            <a href="../index.php">Admin Homepage</a>
        </p>

        <table class="table table-bordered mt-5">
            <thead class="bg-secondary">
                <tr>
               
                    <th>Cart_ID</th>

                    <th>User_ID (Buyer)</th>

                    <th>Product_ID</th>


                </tr>
            </thead>
            <tbody class="bg-primary">
                <?php
                $display_cart_query = "SELECT * FROM cart";
                $cart_query_result = mysqli_query($conn, $display_cart_query);

                while ($row = mysqli_fetch_assoc($cart_query_result)) {
                    $cart_id = $row['cart_id'];
                    $user_id = $row['user_id'];
                    $product_id = $row['product_id'];
                    

                    ?>
                        <tr>

                            <td><?php echo $cart_id ?></td>

                            <td><?php echo $user_id ?></td>

                            <td><?php echo $product_id ?></td>

                            
                
                        </tr>
                <?php


                }
                ?>
                
            </tbody>

        </table>

    <?php else:
        header("Location: ../index.php");
        ?>

    <?php endif; ?>
</body>

</html>