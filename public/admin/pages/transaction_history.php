<?php
session_start();
$loggedIn = isset($_SESSION['admin_id']);
include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>Transaction History</title>

    <style>/* Keeps the images to 100x100 px  */
        img{
            float: left;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        table, th, td{
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
        <h1>Transaction History</h1>
        
        <p>
            <a href="../index.php">Admin Homepage</a>
        </p>

        <table class="table table-bordered mt-5">
            <thead class="bg-secondary">
                <tr>
                    <th>Order_ID</th>

                    <th>User_ID (Buyer)</th>

                    <th>Name</th>

                    <th>Price</th>

                    <th>Description</th>

                    <th>Image</th>


                </tr>
            </thead>
            <tbody class="bg-primary">
                <?php
                $display_products_query = "SELECT * FROM order_history";
                $prod_query_result = mysqli_query($conn, $display_products_query);

                while ($row = mysqli_fetch_assoc($prod_query_result)) {
                    $order_history_id = $row['order_history_id'];
                    $user_id = $row['user_id'];
                    $prod_name = $row['name'];
                    $prod_price = $row['price'];
                    $prod_desc = $row['description'];
                    $image_path = $row['image_path'];

                    ?>
                        <tr>
                            <td><?php echo $order_history_id ?></td>

                            <td><?php echo $user_id ?></td>

                            <td><?php echo $prod_name ?></td>

                            <td><?php echo $prod_price ?></td>

                            <td><?php echo $prod_desc ?></td>

                            <td>
                                <img src='../../assets/images/uploads/<?php echo $image_path ?>' alt="Missing"/>
                            </td>
                  
                            
                
                        </tr>
                <?php


                }
                ?>
                
            </tbody>

        </table>
    <?php
    else:
        header("Location: ../index.php");
        ?>

    <?php endif; ?>
</body>

</html>