<?php
include 'layout/user/header_user.php';
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Dashboard</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card mb-4">
            <div class="card-header bg-primary text-white">Total number of rooms</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <?php
              $sql = "SELECT * FROM room";
              $result = mysqli_query($conn, $sql);
              echo mysqli_num_rows($result) . " room(s)";
              ?>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card mb-4">
            <div class="card-header bg-warning text-white">Total number of cats</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <?php
              $sql = "SELECT * FROM cat";
              $result = mysqli_query($conn, $sql);
              echo mysqli_num_rows($result) . " cat(s)";
              ?>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card mb-4">
            <div class="card-header bg-success text-white">Total number of bookings</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <?php
              $sql = "SELECT * FROM booking";
              $result = mysqli_query($conn, $sql);
              echo mysqli_num_rows($result) . " booking(s)";
              ?>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card mb-4">
            <div class="card-header bg-danger text-white">Total number of customers</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <?php
              $sql = "SELECT * FROM user WHERE user_role='Customer'";
              $result = mysqli_query($conn, $sql);
              echo mysqli_num_rows($result) . " customer(s)";
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php
  include 'layout/user/footer_user.php';
  ?>