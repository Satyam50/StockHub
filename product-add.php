<?php
session_start();

if (!isset($_SESSION["users"])) {
    header('location: login.php');
    exit();
}

$_SESSION['table'] = 'products'; // Consider removing if not needed
$users = $_SESSION['users'];

// Fetch all products from the database
$allProducts = include('database/show-products.php');

// Ensure $allProducts is set and is an array
if (!is_array($allProducts)) {
    $allProducts = [];
}

// Check if form is submitted for adding a new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_product') {
    // Validate and sanitize inputs (you should implement proper validation)
    $productName = $_POST['product_name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0.0;
    $quantity = $_POST['quantity'] ?? 0;

    // Example validation: Ensure required fields are not empty
    if (empty($productName) || empty($price) || empty($quantity)) {
        $_SESSION['response'] = [
            'success' => false,
            'message' => 'Please fill in all required fields.'
        ];
    } else {
        // Insert product into the database (you need to implement this part)
        // Example: Simulate database insertion (replace with actual database insert query)
        // $success = insertProduct($productName, $description, $price, $quantity);
        // For now, let's assume it's successful
        $success = true;

        if ($success) {
            $_SESSION['response'] = [
                'success' => true,
                'message' => 'Product added successfully.'
            ];
        } else {
            $_SESSION['response'] = [
                'success' => false,
                'message' => 'Failed to add product. Please try again.'
            ];
        }
    }

    // Redirect back to dashboard to avoid resubmission on refresh
    header('Location: dashboard.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Dashboard - Inventory Management System</title>
    <link rel="stylesheet" href="dashboard.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .productaddformcontainer {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.productaddformcontainer form {
    max-width: 600px;
    margin: 0 auto;
}

.productaddformcontainer label {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
}

.productaddformcontainer input[type=text], 
.productaddformcontainer textarea {
    width: calc(100% - 20px); /* Adjusting for padding */
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.productaddformcontainer textarea {
    height: 100px; /* Adjust height of the textarea */
}

.productaddformcontainer button[type=submit] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 4px;
}

.productaddformcontainer button[type=submit]:hover {
    background-color: #0056b3;
}

.responsemessage {
    margin-top: 10px;
}

.responseMessage__success {
    color: #4CAF50;
}

.responseMessage__error {
    color: #f44336;
}

    </style>

</head>

<body>
    <div id="dashboardmaincontainer">
        <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div class="rows">
                        <div class="columns column5">
                            <h1 class="section_header"> <i class="fa fa-plus"></i> Add Product</h1>
                            <div class="productaddformcontainer">
                                <form action="database/add-product.php" method="POST" class="appform">
                                    <div>
                                        <label for="product_name">Product Name</label>
                                        <input type="text" name="product_name" id="product_name">
                                    </div>

                                    <div>
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description"></textarea>
                                    </div>

                                    <div>
                                        <label for="price">Price</label>
                                        <input type="text" name="price" id="price">
                                    </div>

                                    <div>
                                        <label for="quantity">Quantity</label>
                                        <input type="text" name="quantity" id="quantity">
                                    </div>
                                    <input type="hidden" name="table" value="products" />
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Product</button>
                                </form>

                                <?php
                                if (isset($_SESSION['product_response'])) {
                                    $response_message = $_SESSION['product_response']['message'];
                                    $is_success = $_SESSION['product_response']['success'];
                                ?>
                                    <div class="responsemessage">
                                        <p class="<?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>">
                                            <?= $response_message ?>
                                        </p>
                                    </div>
                                <?php
                                    unset($_SESSION['product_response']);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="columns column7">
                            <h1 class="section_header"><i class="fa fa-list"></i> List of Products</h1>
                            <div class="section_content">
                                <div class="products">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Index</th>
                                                <th>Product Name</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($allProducts as $index => $product): ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                                                    <td><?= htmlspecialchars($product['description']) ?></td>
                                                    <td><?= htmlspecialchars($product['price']) ?></td>
                                                    <td><?= htmlspecialchars($product['quantity']) ?></td>
                                                    <td><?= htmlspecialchars($product['created_at']) ?></td>
                                                    <td><?= htmlspecialchars($product['updated_at']) ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary edit-product" data-productid="<?= $product['id'] ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a href="#" class="btn btn-sm btn-danger delete-product" data-productid="<?= $product['id'] ?>" data-productname="<?= $product['product_name'] ?>"><i class="fa fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        $(document).ready(function() {
            // Delete product handler
            $('.delete-product').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('productid');
                var productName = $(this).data('productname');

                if (confirm('Are you sure to delete ' + productName + '?')) {
                    $.ajax({
                        method: 'POST',
                        url: 'database/delete-product.php',
                        data: { product_id: productId },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                alert('Product deleted successfully.');
                                window.location.reload();
                            } else {
                                alert('Error deleting product: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }
            });

            // Edit product handler
            $('.edit-product').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('productid');

                // Redirect to update-product.php with the product ID as a query parameter
                window.location.href = 'database/update-product.php?id=' + productId;
            });
        });
    </script>
</body>


</html>
