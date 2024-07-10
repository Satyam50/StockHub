<?php
session_start();

if (!isset($_SESSION["users"])) {
    header('location: login.php');
    exit();
}

$_SESSION['table'] = 'users'; // Consider removing if not needed
$users = $_SESSION['users'];

// Fetch all users from the database
$allUsers = include('database/show-user.php');

// Ensure $allUsers is set and is an array
if (!is_array($allUsers)) {
    $allUsers = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventory Management System</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/e8e62639f1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->
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
                            <h1 class="section_header"> <i class="fa fa-plus"></i> Create User</h1>
                            <div class="useraddformcontainer">
                                <form action="database/add.php" method="POST" class="appform">
                                    <div>
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name">
                                    </div>

                                    <div>
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name">
                                    </div>

                                    <div>
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email">
                                    </div>

                                    <div>
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password">
                                    </div>
                                    <input type="hidden" name="table" value="users" />
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</button>
                                </form>

                                <?php
                                if (isset($_SESSION['response'])) {
                                    $response_message = $_SESSION['response']['message'];
                                    $is_success = $_SESSION['response']['success'];
                                ?>
                                    <div class="responsemessage">
                                        <p class="<?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>">
                                            <?= $response_message ?>
                                        </p>
                                    </div>
                                <?php
                                    unset($_SESSION['response']);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="columns column7">
                            <h1 class="section_header"><i class="fa fa-list"></i> List of Users</h1>
                            <div class="section_content">
                                <div class="users">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Index</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($allUsers as $index => $user): ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= htmlspecialchars($user['first_name']) ?></td>
                                                    <td><?= htmlspecialchars($user['last_name']) ?></td>
                                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                                    <td><?= htmlspecialchars($user['created_at']) ?></td>
                                                    <td><?= htmlspecialchars($user['updated_at']) ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary edit-user" data-userid="<?= $user['id'] ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                        <a href="#" class="btn btn-sm btn-danger delete-user" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['first_name'] ?>" data-lname="<?= $user['last_name'] ?>"><i class="fa fa-trash"></i> Delete</a>
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
            // Delete user handler
            $('.delete-user').on('click', function(e) {
                e.preventDefault();
                var userId = $(this).data('userid');
                var fname = $(this).data('fname');
                var lname = $(this).data('lname');
                var fullname = fname + ' ' + lname;

                if (confirm('Are you sure to delete ' + fullname + '?')) {
                    $.ajax({
                        method: 'POST',
                        url: 'database/delete-user.php',
                        data: { user_id: userId },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                alert('User deleted successfully.');
                                window.location.reload();
                            } else {
                                alert('Error deleting user: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }
            });

            // Edit user handler
            $('.edit-user').on('click', function(e) {
                e.preventDefault();
                var userId = $(this).data('userid');

                // Redirect to update-user.php with the user ID as a query parameter
                window.location.href = 'database/update-user.php?id=' + userId;

            });
        });
    </script>
</body>

</html>
