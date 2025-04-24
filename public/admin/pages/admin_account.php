<?php
session_start();
$loggedIn = isset($_SESSION['admin_id']);
include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";

if ($loggedIn === true):
    $curr_admin_user = $_SESSION['admin_user'];
    $admin_id = $_SESSION['admin_id'];

endif;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $admin_id_del = $_POST["admin_id"];
    

    if(empty($admin_id_del)){
        $errors[] = "Error Deleting Admin";
    }else{

        $stmt = $conn->prepare("DELETE FROM admins WHERE admin_id = ?");

        $stmt->bind_param("s", $admin_id_del);

        if($stmt->execute()){
            $_SESSION["success"] = "Admin Successfully Deleted";

            session_destroy();
            header("Location: ../index.php");
            exit;
            
        }else{
            $errors[] = "Problem Deleting Admin";
        }
        $stmt->close();
        
    }
    
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>Admin Account Settings</title>

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
        <h1>Admin Account Settings</h1>
        <p>Welcome <?= $curr_admin_user ?> </p>

        <p>
            <a href="../index.php">Admin Homepage</a>
        </p>

        
        <form action="admin_account.php" method="POST">

            <input type="hidden" name="admin_id" value="<?= $admin_id ?>"/>
            <button>Delete Account</button>

        </form>

    <?php else:
        header("Location: /index.php");
    ?>

    <?php endif; ?>
</body>

</html>