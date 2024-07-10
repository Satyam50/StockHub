# StockHub - Inventory Management System

StockHub is a web-based Inventory Management System designed to streamline product and user management tasks. It provides an intuitive interface for adding, editing, and deleting products, managing user accounts, and viewing detailed product and user information.

## Features

- **Product Management:**
  - Add new products with details such as name, description, price, and quantity.
  - Edit existing product information.
  - Delete products from the inventory.

- **User Management:**
  - Secure user authentication and session management.
  - Access control for different user roles.

- **Dashboard:**
  - Overview of product and user statistics.
  - Quick access to add, edit, and delete functionalities.

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP
- **Database:** MySQL
- **External Libraries:** Font Awesome, jQuery, Bootstrap

## Getting Started

To run the StockHub Inventory Management System locally, follow these steps:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/stockhub.git
   cd stockhub


Start the PHP development server:

bash
Copy code
php -S localhost:8000





Login:

Use the provided login credentials to access the dashboard:

Username: [Your admin username]
Password: [Your admin password]
Folder Structure
perl
Copy code
stockhub/
├── database/
│ ├── connection.php # Database connection setup
│ ├── show-products.php # Script to fetch all products
│ ├── add-product.php # Script to add a new product
│ ├── delete-product.php # Script to delete a product
│ ├── show-users.php # Script to fetch all users
│ ├── add-user.php # Script to add a new user
│ ├── delete-user.php # Script to delete a user
│ └── update-user.php # Script to update user information

├── css/
│ └── dashboard.css # Stylesheet for dashboard

├── js/
│ └── script.js # JavaScript functions

├── partials/
│ ├── app-sidebar.php # Sidebar navigation
│ └── app-topnav.php # Top navigation bar

├── index.php # Login page
├── dashboard.php # Main dashboard page
├── product-add.php # Page to add new products
├── product-list.php # Page to list all products
├── user-add.php # Page to add new users
└── README.md       
