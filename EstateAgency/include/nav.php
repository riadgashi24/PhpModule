<?php
session_start();
?>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Estate<span>Agency</span></h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="properties.php">Properties</a></li>
          <li><a href="agents.php">Agents</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <nav>
        <!-- ... your other nav links ... -->
        <?php if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'agent' && $_SESSION['role'] !== 'admin')): ?>
          <a href="login.php">Agent/Admin Login</a>
        <?php else: ?>
          <a href="logout.php">Logout</a>
          <?php if ($_SESSION['role'] === 'agent'): ?>
            <a href="add-property.php">Add Property</a>
          <?php elseif ($_SESSION['role'] === 'admin'): ?>
            <a href="add-user.php">Add User</a>
          <?php endif; ?>
        <?php endif; ?>
      </nav>

    </div>
  </header>
