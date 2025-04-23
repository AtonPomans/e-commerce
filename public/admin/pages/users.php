<?php
    session_start();
    $loggedIn = isset($_SESSION['admin_id']);
    include $_SERVER['DOCUMENT_ROOT'] . "/../config/db.php";
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title>Users</title>
</head>

<body>
    <?php if ($loggedIn): ?>
        <h1>Users</h1>
    <?php else:
        header("Location: ../index.php");    
    ?>

    <?php endif; ?>
</body>

</html>