<?php
// show-products.php

try {
    // Example PDO connection setup (replace with your actual connection logic)
    $pdo = new PDO('mysql:host=localhost;dbname=inventory', 'root', '');

    // Example query to fetch products
    $stmt = $pdo->query("SELECT * FROM products");
    $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the array of products
    return $allProducts;
} catch (PDOException $e) {
    // Handle database errors (you can log or output the error)
    die("Database error: " . $e->getMessage());
}
