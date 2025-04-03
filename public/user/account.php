
<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/../includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../config/db.php';

//Select information from users table to display on dashboard
$sql_users = "SELECT first_name, last_name
        FROM users";
$result_users = $conn->query($sql_users);
$row_users = $result_users->fetch_assoc()

//query might need to go here to pull information from user_address table
//I need to look at Amazon and Newegg to see how they format their user dashboards
?>

<body>
    <main>

        <div class="container-fluid bg-light py-5">
            <div class="m-auto text-left col-md-6">
                <h1 class="h1">User Dashboard</h1>
                <h4>User: </h4>
                <p> 
                    <?php echo htmlspecialchars($row_users['first_name']); ?> <?php echo htmlspecialchars($row_users['last_name']); ?>
                </p>
                
            </div>
        </div>

    </main>
</body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/../includes/footer.php'; ?>

