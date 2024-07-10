<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_name = $_POST['table']; // Assuming you're passing the table name from the form

    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Include database connection file
    include('connection.php');

    // Adding the record
    try {
        // Use prepared statements to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO $table_name (product_name, description, price, quantity, created_at, updated_at) VALUES (:product_name, :description, :price, :quantity, NOW(), NOW())");
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);

        $stmt->execute();

        $response = [
            'success' => true,
            'message' => 'Product added successfully.'
        ];

    } catch(PDOException $e) {
        $response = [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }

    $_SESSION['product_response'] = $response;
    header('Location: /project_sp/product-add.php'); // Redirect to your dashboard or another desired page
    exit(); // Ensure no further code execution after redirection
} else {
    header('Location: ../product-add.php'); // Redirect if not a POST request
    exit();
}
?>
