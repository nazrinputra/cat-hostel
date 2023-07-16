<?php
include 'config/db.php';

if (!$logged_in) {
  header("Location: login.php");
  exit();
}

if (isset($_POST['logout-button'])) {
  session_destroy();
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Cat Hostel</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-flex justify-content-between">
    <div>
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3" href="index.html">Cat Hostel</a>
      <!-- Sidebar Toggle-->
      <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li>
        <hr class="dropdown-divider" />
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user fa-fw"></i>
          <?php
          echo ucwords($_SESSION["user_name"]);
          ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li>
            <a class="dropdown-item fs-6 disabled" href="#">
              <?php
              echo $_SESSION["user_email"];
              ?>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <form action="" method="POST">
              <button type="submit" class="dropdown-item" name="logout-button">Logout</button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <a class="nav-link" href="/index.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            <a class="nav-link" href="/bookings.php">
              <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
              Bookings
            </a>
            <a class="nav-link" href="/rooms.php">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-shield-cat"></i></div>
              Rooms
            </a>
            <a class="nav-link" href="/cats.php">
              <div class="sb-nav-link-icon"><i class="fa-solid fa-cat"></i></div>
              Cats
            </a>
            <?php
            if ($_SESSION["user_role"] == "Staff") {
            ?>
              <div class="sb-sidenav-menu-heading">Administration</div>

              <a class="nav-link" href="/customers.php">
                <div class="sb-nav-link-icon"><i class="fa-regular fa-address-book"></i></div>
                Customers
              </a>
              <a class="nav-link" href="/staffs.php">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-shield"></i></div>
                Staffs
              </a>
            <?php
            }
            ?>
          </div>
        </div>
      </nav>
    </div>