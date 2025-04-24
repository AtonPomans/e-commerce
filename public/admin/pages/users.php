<?php
    session_start();
    $loggedIn = isset($_SESSION['admin_id']);
    include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>Users</title>

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
        <h1>User Management</h1>

        <p>
            <a href="../index.php">Admin Homepage</a>
        </p>

        <table class="table table-bordered mt-5">
            <thead class="bg-secondary">
                <tr>
               
                    <th>User_ID</th>

                    <th>First_Name</th>

                    <th>Last_Name</th>

                    <th>email</th>

                    <!--<th>Password</th>-->

                    <th>Account Created</th>

                    <th>Remove User</th>

                </tr>
            </thead>
            <tbody class="bg-primary">
                <?php
                $display_users_query = "SELECT * FROM users";
                $users_query_result = mysqli_query($conn, $display_users_query);

                while ($row = mysqli_fetch_assoc($users_query_result)) {
                    $user_id = $row['user_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $email = $row['email'];
                    $password = $row['password_hash'];
                    $act_crt_date = $row['created_at'];

                    ?>
                        <tr>

                            <td><?php echo $user_id ?></td>

                            <td><?php echo $first_name ?></td>

                            <td><?php echo $last_name ?></td>

                            <td><?php echo $email ?></td>

                            <!--<td> echo $password </td>-->

                            <td>
                                <?php echo $act_crt_date ?>
                            </td>
                  
                            <td>
                                <form action="./delete_user.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?= $user_id ?>"/>
                                    <button class="btn">Delete</button>
                                </form>
                            </td>
                
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