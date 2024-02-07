<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CI-WMS</title>

  <link rel="stylesheet" href="app/styles/css/general.css">
  <link rel="stylesheet" href="app/styles/css/header.css">
  <link rel="stylesheet" href="app/styles/css/footer-sidebar.css">
  <link rel="stylesheet" href="app/styles/css/nav-sidebar.css">
  <link rel="stylesheet" href="app/styles/css/container-table.css">
  <link rel="stylesheet" href="app/styles/font-awesome/css/font-awesome.min.css">
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="sidebar-header">
      <div class="header-logo">
        <img src="app/picture/logo.png">
        <div class="logo-name">CI-WMS</div>
      </div>
    </div>
  </header>
  <!-- Header -->

  <!-- Sidebar -->
  <nav>
    <div class="sidebar">
      <ul class="sidebar-listmenu">
        <li class="main-menu-row">Main-Menu</li>
        <li class="item">
          <a href="#">
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="item">
          <a href="#">
            <i class="fa fa-archive" aria-hidden="true"></i>
            <span>Master of Goods</span>
          </a>
        </li>
        <li class="item">
          <a href="#">
            <i class="fa fa-list" aria-hidden="true"></i>
            <span>Minimum Stock</span>
          </a>
        </li>
        <li class="item">
          <a class="collapsible">
            <i class="fa fa-exchange" aria-hidden="true"></i>
            <span>Transactions</span>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <ul class="content">
              <li>
                <a class="item-link" href="#">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Incoming Goods</span>
                </a>
              </li>
              <li>
                <a class="item-link" href="#">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Outgoing Goods</span>
                </a>
              </li>
              <li>
                <a class="item-link" href="#">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Adjustment</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="item">
          <a class="collapsible">
            <i class="fa fa-exchange" aria-hidden="true"></i>
            <span>Reports</span>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <ul class="content">
              <li>
                <a class="item-link" href="#">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Incoming Goods</span>
                </a>
              </li>
              <li>
                <a class="item-link" href="#">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Outgoing Goods</span>
                </a>
              </li>
              <li>
                <a class="item-link" href="#">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Adjustment</span>
                </a>
              </li>
            </ul>
          </a>
        </li>
        <li class="item">
          <a class="collapsible">
            <i class="fa fa-exchange" aria-hidden="true"></i>
            <span>Master List</span>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <ul class="content">
              <li>
                <a class="item-link" href="#">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Incoming Goods</span>
                </a>
              </li>
              <li>
                <a class="item-link" href="#">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Outgoing Goods</span>
                </a>
              </li>
              <li>
                <a class="item-link" href="#">
                  <i class="fa fa-angle-right" aria-hidden="true"></i>
                  <span>Adjustment</span>
                </a>
              </li>
            </ul>
          </a>
        <li class="item">
          <a href="#">
            <i class="fa fa-cogs" aria-hidden="true"></i>
            <span>System Information</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- Sidebar - footer -->
    <div class="sidebar-footer-grid">
      <a href="#"><i class="fa fa-home" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-lock" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-power-off" aria-hidden="true"></i></a>
    </div>
    <!-- Sidebar - footer -->
  </nav>
  <!-- Sidebar -->  

  <!-- Footer -->
  <footer class="site-footer-flex">
    <div class="site-footer-left">
      <span class="span-footer-left">© 2024 CI-WMS</span>
    </div>

    <div class="site-footer-right">
      <span class="span-footer-right">CI PHP-Project</span>
    </div>
  </footer>
  <!-- Footer -->

  <!-- Main Content -->
  <main>
    <!-- Для $content -->
    <p class="paragraph">Table</p>
  </main>
  <!-- Main Content -->
  <script src="app/js/scripts/collapsible-scripts.js"></script>
</body>
</html>