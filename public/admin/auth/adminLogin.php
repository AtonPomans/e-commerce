<?php
    //session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";

    $invalid_submission = false;

    /*
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mysqli = require __DIR__ . "/../../../config/db.php";
        $sql = sprintf("SELECT * FROM admins
                        WHERE email = '%s'",
                        $_POST["email"]
                       );

        $result = $mysqli->query($sql);
        $admin = $result->fetch_assoc();

        if ($admin) {
            if ($_POST["password"] === $admin["password"]) {

                session_start();
                $_SESSION["admin_id"] = $admin["admin_id"];

                header("Location: ../index.php");
                exit;
            }
        }

        $invalid_submission = true;

    }
    */
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(empty($email) || empty($password)){
            $errors[] = "Password and Email Required";

            $invalid_submission = true;
            
        }else{
            $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows > 0){
                $stmt->bind_result($admin_id, $admin_user, $email, $password);
                $stmt->fetch();

                if($_POST["password"] === $password){
                    session_start();
                    $_SESSION["admin_id"] = $admin_id;
                    $_SESSION["admin_user"] = $admin_user;

                    header("Location: ../index.php");
                    exit;
                    
                }else{
                
                    $errors[] = "Incorrect Password";
                    $invalid_submission = true;
                }
                
            }else{
                
                $errors[] = "Invalid Login Credentials";
                $invalid_submission = true;

            }

        }
    }
    
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        Admin Log In
    </title>

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
    <h1>Admin Log In</h1>
    <p>
        <a href="../index.php">Home Page</a>
    </p>

    <?php if ($invalid_submission): ?>
        <em>Invalid Login Information: Try Again</em>
    <?php endif; ?>

    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email" />

        <label for="password">Password</label>
        <input type="password" name="password" id="password" />

        <button>Log In</button>
    </form>

</body>

</html>