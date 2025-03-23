<?php
require('db.php');
include("auth_session.php");

$userEmail = $_SESSION['email'];
$query = "SELECT first_name, last_name FROM users WHERE email = '$userEmail'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);
$fullName = $user['first_name'] . ' ' . $user['last_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Client area</title>
    <link rel="stylesheet" href="/assets/css/securestyle.css" />
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $fullName; ?>!</p>
        <p>You are now user dashboard page.</p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
