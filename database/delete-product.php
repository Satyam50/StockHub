<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_name = $_SESSION['table'];

    // Retrieve the product ID from POST data
    $product_id = $_POST['product_id'];

    // Include database connection file
    include('connection.php');

    // Deleting the record
    try {
        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("DELETE FROM $table_name WHERE id = :id");
        $stmt->bindParam(':id', $product_id);
        $stmt->execute();

        $response = [
            'success' => true,
            'message' => 'Product deleted successfully.'
        ];

    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }

    $_SESSION['response'] = $response;
    echo json_encode($response);
    exit();
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
