<?php
session_start();

// Redirect back if session response not set
if (!isset($_SESSION['response'])) {
    header('Location: /project_sp/pop-up.php');

    exit();
}

/*Store response message
$response_message = $_SESSION['response']['message'];

Unset session response after displaying popup
unset($_SESSION['response']);*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>succesfull</title>
    <link rel="stylesheet" href="pop-up.css">
</head>
<body>
    <div class="popup-box" id="popup-box">
        <div class="popup-content">
            <span class="close-btn" id="close-btn">&times;</span>
            <div class="popup-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15-5-5 1.41-1.41L11 14.17l7.59-7.59L20 8l-9 9z" fill="#4CAF50"/>
                </svg>
            </div>
            <p>User added successfully!</p>
            <button class="ok-btn" id="ok-btn">OK</button>
        </div>
    </div>

    <script src="js\pop-up.js"> </script>
    <script>
        document.getElementById('ok-btn').addEventListener('click', function() {
            window.location.href = '/project_sp/user-add.php';
        });
    </script>
</body>
</html>
