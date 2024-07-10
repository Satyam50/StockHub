<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_name = $_SESSION['table'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypted = password_hash($password, PASSWORD_DEFAULT);

    // Include database connection file
    include('connection.php');

    // Adding the record
    try {
        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO $table_name (first_name, last_name, email, password, created_at, updated_at) VALUES (:first_name, :last_name, :email, :password, NOW(), NOW())");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $encrypted);

        $stmt->execute();

        $response = [
            'success' => true,
            'message' => header('Location:/project_sp/pop-up.php')
        ];

    } catch(PDOException $e) {
        $response = [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }

    $_SESSION['response'] = $response;
   // header('Location:/project_sp/pop-up.php');
    exit(); // Ensure no further code execution after redirection
} else {
    header('Location: ../user-add.php');
    exit();
}
?>
