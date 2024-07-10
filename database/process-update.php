<?php
session_start();

// Include database connection
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Update user data in the database
    $stmt = $conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email WHERE id = :id");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $user_id);

    try {
        $stmt->execute();
        $_SESSION['response'] = [
            'success' => true,
            'message' => 'User updated successfully.'
        ];
    } catch (PDOException $e) {
        $_SESSION['response'] = [
            'success' => false,
            'message' => 'Error updating user: ' . $e->getMessage()
        ];
    }

    // Redirect back to user-add.php or update-user.php as appropriate
    header('Location: ../user-add.php');
    exit();
} else {
    // Invalid request
    $_SESSION['response'] = [
        'success' => false,
        'message' => 'Invalid request.'
    ];
    header('Location: ../user-add.php');
    exit();
}
?>
