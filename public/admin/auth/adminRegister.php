<?php
session_start();
$loggedIn = isset($_SESSION['admin_id']);
include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $admin_user = $_POST["admin_user"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if(empty($admin_user)||empty($email)||empty($password)||empty($confirm_password)){
        $errors[] = "Invalid Registration";
    }elseif($password !== $confirm_password){
        $errors[] = "Password does not match";
        
    }else{

        $stmt = $conn->prepare("INSERT INTO admins (admin_user, email, password)
        VALUES (?, ?, ?)");

        $stmt->bind_param("sss", $admin_user, $email, $password);

        if($stmt->execute()){
            $_SESSION["success"] = "Admin Successfully Registered";

            header("Location: ./adminRegister.php");
            exit;
            
        }else{
            $errors[] = "Problem with Admin Registration System";
        }
        $stmt->close();
        
    }
    


}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>Admin Registration</title>
</head>

<body>
    <?php if ($loggedIn): ?>
        <h1>Admin Registration</h1>

        <p>
            <a href="../index.php">Admin Homepage</a>
        </p>
        
        <form action="adminRegister.php" method="POST">

            <label for="admin_user">Username</label>
            <input type="text" name="admin_user" id="admin_user"/>

            <label for="email">email</label>
            <input type="email" name="email" id="email" />

            <label for="password">Password</label>
            <input type="password" name="password" id="password"/>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password"/>

            <button>Register New Admin</button>

        </form>

    <?php else:
        header("Location: ../index.php");
    ?>

    <?php endif; ?>
</body>

</html>