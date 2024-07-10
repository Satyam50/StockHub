<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Inventory Management System</title>
  <style>
    /* Global reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Main container and sidebar */
    #dashboardmaincontainer {
      display: flex;
      height: 100vh;
    }

    .dashboard_Sidebar {
      width: 20%;
      background: #323232;
      height: 100%;
      display: flex;
      flex-direction: column;
      padding-top: 20px;
    }

    .dashboard_logo {
      color: #f685a1;
      font-size: 36px;
      text-align: center;
      margin-bottom: 20px;
    }

    .dashboard_sidebar_user {
      text-align: center;
      padding-bottom: 20px;
      border-bottom: 1px solid #fff;
      margin-bottom: 20px;
    }

    .dashboard_sidebar_user img {
      width: 60px;
      border-radius: 50%;
      border: 2px solid #fff;
    }

    .dashboard_sidebar_user span {
      display: block;
      font-size: 18px;
      color: #fff;
      margin-top: 10px;
    }

    /* Main menu and submenus */
    .dashboard_menu_lists {
      list-style: none;
      padding: 0;
    }

    .limainmenu {
      margin-bottom: 10px;
    }

    .limainmenu a {
      display: flex;
      
      align-items: center;
      padding: 10px 20px;
      color: #fff;
      text-decoration: none;
      font-size: 18px;
      position: relative;
    }

    .limainmenu a:hover {
      background-color: #f685a1;
    }

    .limainmenu a i {
      margin-right: 10px;
    }

    /* Submenu styles */
    .submenus {
      display: none;
      list-style-type: none;
      padding-left: 0;
      margin-top: 5px;
    }

    .submenus a {
      display: block;
      padding: 8px 20px;
      color: #ddd;
      text-decoration: none;
      font-size: 16px;
    }

    .submenus a:hover {
      background-color: #555;
    }

    /* Arrow styles */
    .arrow-icon {
      font-size: 12px;
      transition: transform 0.3s ease;
    }

    .submenu-open .arrow-icon {
      transform: rotate(180deg);
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="dashboard_Sidebar" id="dashboard_sidebar">
    <h3 class="dashboard_logo" id="dashboard_logo">IMS</h3>
    <div class="dashboard_sidebar_user">
      <img src="myprofile.png" alt="user image" id="userImage" />
      <span id="username"><?= $users['first_name'] . ' ' . $users['last_name'] ?></span>
    </div>
    <div class="dashboard_sidebar_menus">
      <ul class="dashboard_menu_lists">
        <li class="limainmenu">
          <a href="user-add.php">
            <i class="fa fa-dashboard"></i><span class="menutext">Dashboard</span>
          </a>
        </li>
        <li class="limainmenu">
          <a href="#" onclick="toggleSubMenu('productSubMenu', this)">
            <i class="fa fa-tag"></i><span class="menutext">Product Management</span>
            <i class="fa fa-chevron-down arrow-icon"></i>
          </a>
          <ul class="submenus" id="productSubMenu">
            <li><a href="product-add.php"><i class="fa fa-circle"></i>Add Product / View Products</a></li>
          </ul>
        </li>
        <li class="limainmenu">
          <a href="#" onclick="toggleSubMenu('supplierSubMenu', this)">
            <i class="fa fa-truck"></i><span class="menutext">Supplier Management</span>
            <i class="fa fa-chevron-down arrow-icon"></i>
          </a>
          <ul class="submenus" id="supplierSubMenu">
            <li><a href="#"><i class="fa fa-circle"></i>View Suppliers</a></li>
            <li><a href="#"><i class="fa fa-circle"></i>Add Supplier</a></li>
          </ul>
        </li>
        <li class="limainmenu">
          <a href="#" onclick="toggleSubMenu('userSubMenu', this)">
            <i class="fa fa-user-plus"></i><span class="menutext">User Management</span>
            <i class="fa fa-chevron-down arrow-icon"></i>
          </a>
          <ul class="submenus" id="userSubMenu">
            
            <li><a href="./user-add.php"><i class="fa fa-circle"></i>Add Users / View Users</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>

  <script>
    // JavaScript to toggle submenu visibility
    function toggleSubMenu(submenuId, element) {
      var submenu = document.getElementById(submenuId);
      if (submenu.style.display === 'block') {
        submenu.style.display = 'none';
        element.classList.remove('submenu-open');
      } else {
        submenu.style.display = 'block';
        element.classList.add('submenu-open');
      }
    }
  </script>
</body>
</html>
