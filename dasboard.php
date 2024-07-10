<?php

session_start();

if (!isset($_SESSION["users"])) {
    header('location: login.php');
    exit();
}
$users=$_SESSION['users'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventory Management System</title>
    <link rel="stylesheet" href="dasboard.css">
    <script src="https://kit.fontawesome.com/e8e62639f1.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="dashboardmaincontainer">
    <?php include('partials/app-sidebar.php')?>
        <div class="dashboard_content_container" id="dashboard_content_container">
        <?php include('partials/app-topnav.php')?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <!-- Main content here -->
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js">
    </script>
</body>

</html>
