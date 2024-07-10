<?php
//start the session

session_start();

if (isset($_SESSION['users'])) {
    header("Location: dasboard.php");
    exit();
}


$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('database/connection.php');

    if (empty($error_message)) { // Ensure no connection error before proceeding
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query='SELECT * FROM users WHERE users.email="'.$username.'" AND users.password="'. $password.'"';
        $stmt = $conn->prepare($query);
        $stmt->execute();


        

        if ($stmt->rowCount() > 0) {
            // Successful login logic
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $users=$stmt->fetchAll()[0];
            $_SESSION['users']=$users;
            header('Location:dasboard.php');
        
        } else {
            $error_message = 'Please make sure that username and password are correct.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Login - Inventory management system</title>
    <link rel="stylesheet" href="login.css">
</head>

<body id="loginBody">
    <?php if (!empty($error_message)) { ?>
        <div id="errorMessage" style="background: #fff; text-align: center; color: red; font-size: 20px; padding: 11px;">
            <strong>ERROR:</strong> <p style="font-style:italic; font-size:15px" ><?= $error_message ?></p>
        </div>
    <?php } ?>

    <div class="container">
        <div class="loginHeader">
            <h1>StockHub</h1>
            <p>Inventory Management System</p>
        </div>
        <div class="loginBody">
            <form id="loginForm" action="login.php" method="POST">
                <div class="loginInputContainer">
                    <label for="">USERNAME</label>
                    <input placeholder="Username" name="username" type="text">
                </div>
                <div class="loginInputContainer">
                    <label for="">PASSWORD</label>
                    <input placeholder="Password" name="password" type="password">
                </div>
                <div class="buttonset">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
