 
<?php
session_start();

// Destroy the session to log out the user
session_destroy();

// Set a session response for the logout
session_start();
$_SESSION['response'] = [
    'message' => 'You have been logged out of your account.',
    'success' => true
];

// Redirect to the logout popup page
header('Location: /project_sp/logout-popup.php');
exit();
?>


