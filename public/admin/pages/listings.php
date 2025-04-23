<?php
    session_start();
    $loggedIn = isset($_SESSION['admin_id']);
    include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>Listings</title>

    <style>/* Keeps the images to 100x100 px  */
        img{
            float: left;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
    
</head>

<body>
    <?php if ($loggedIn): ?>
        <h1>Listings</h1>

        <p>
            <a href="../index.php">Admin Homepage</a>
        </p>

        <table class="table table-bordered mt-5">
            <thead class="bg-secondary">
                <tr>
                    <th>Product_ID</th>

                    <th>User_ID</th>

                    <th>Product Name</th>

                    <th>Price</th>

                    <th>Description</th>

                    <th>Category_ID</th>

                    <th>Image_Path</th>

                    <th>Remove Listing</th>

                </tr>
            </thead>
            <tbody class="bg-primary">
                <?php
                    $display_products_query = "SELECT * FROM products";
                    $prod_query_result = mysqli_query($conn, $display_products_query);

                    while($row = mysqli_fetch_assoc($prod_query_result)){
                        $product_id = $row['product_id'];
                        $user_id = $row['user_id'];
                        $prod_name = $row['name'];
                        $prod_price = $row['price'];
                        $prod_desc = $row['description'];
                        $category_id = $row['category_id'];
                        $image_path = $row['image_path'];
                
                    ?>
                        <tr>
                            <td><?php echo $product_id?></td>

                            <td><?php echo $user_id ?></td>

                            <td><?php echo $prod_name ?></td>

                            <td><?php echo $prod_price ?></td>

                            <td><?php echo $prod_desc ?></td>

                            <td><?php echo $category_id ?></td>

                            <td>
                                <img src='../../assets/images/uploads/<?php echo $image_path?>' alt="Missing"/>
                            </td>
                  
                            <td>
                                <form action="./delete_product.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?= $product_id?>"/>
                                    <button class="btn">Delete</button>
                                </form>
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