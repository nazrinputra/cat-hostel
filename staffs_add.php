<?php
include 'layout/user/header_user.php';

if (isset($_POST['save-button'])) {
  // clean data 
  $user_name_register = stripslashes($_POST['username']);
  $user_email_register = stripslashes($_POST['email']);
  $user_ic_register = stripslashes($_POST['ic']);
  $user_password_register = stripslashes($_POST['password']);
  $user_contact_register = stripslashes($_POST['contact']);
  $user_gender_register = stripslashes($_POST['gender']);

  $user_name_register = mysqli_real_escape_string($conn, $user_name_register);
  $user_email_register = mysqli_real_escape_string($conn, $user_email_register);
  $user_ic_register = mysqli_real_escape_string($conn, $user_ic_register);
  $user_password_register = mysqli_real_escape_string($conn, $user_password_register);
  $user_contact_register = mysqli_real_escape_string($conn, $user_contact_register);
  $user_gender_register = mysqli_real_escape_string($conn, $user_gender_register);

  $sql = "SELECT * FROM user WHERE user_ic='{$user_ic_register}'";
  $result = mysqli_query($conn, $sql);
  $row  = mysqli_fetch_array($result);
  if (is_array($row)) {
    echo '<script>alert("IC already exist!");</script>';
  } else {
    $sql = "INSERT into `user` (user_name, user_password, user_email, user_ic, user_contact, user_gender, user_role, user_active) VALUES ('{$user_name_register}', '{$user_password_register}', '{$user_email_register}', '{$user_ic_register}', '{$user_contact_register}', '{$user_gender_register}', 'Staff', true)";
    $sqlQuery = mysqli_query($conn, $sql);

    if (!$sqlQuery) {
      die("Database connection not established. " . mysqli_error($conn));
    }
    echo '<script>alert("Staff has been registered.");window.location.href="/staffs.php";</script>';
  }
}
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Staffs</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/staffs.php">Staffs</a></li>
        <li class="breadcrumb-item active">Add</li>
      </ol>

      <!-- Add staff form -->
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa-regular fa-address-book"></i>
          Add Staff
        </div>
        <div class="card-body">
          <form action="staffs_add.php" method="POST">
            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="username" name="username" type="text" placeholder="Username" required />
                  <label for="username">Username</label>
                </div>
              </div>
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="password" name="password" type="password" placeholder="Password" required />
                  <label for="password">Password</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="email" name="email" type="email" placeholder="Email" required />
                  <label for="email">Email</label>
                </div>
              </div>
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="ic" name="ic" type="text" placeholder="IC" maxlength="12" required />
                  <label for="ic">IC</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="contact" name="contact" type="text" placeholder="Contact" maxlength="15" required />
                  <label for="contact">Contact</label>
                </div>
              </div>
              <div class="col">
                <select class="form-select form-floating mb-3 py-3" name="gender" aria-label="Select gender" required>
                  <option disabled>Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>


            <div class="d-flex align-items-center justify-content-start mt-4 mb-4">
              <button class="btn btn-primary btn-lg" type="submit" name="save-button">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <?php
  include 'layout/user/footer_user.php';
  ?>