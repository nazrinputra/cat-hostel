<?php
include 'layout/user/header_user.php';

if (isset($_GET['user_id'])) {
  $user_id = $_GET['user_id'];
  $sql = "SELECT * FROM user WHERE user_id='{$user_id}'";
  $result = mysqli_query($conn, $sql);

  $row  = mysqli_fetch_array($result);
}

if (isset($_POST['update-button'])) {
  // clean data 
  $user_id = $_POST['id'];
  $user_name = stripslashes($_POST['username']);
  $user_email = stripslashes($_POST['email']);
  $user_contact = stripslashes($_POST['contact']);
  $user_gender = stripslashes($_POST['gender']);

  $user_name = mysqli_real_escape_string($conn, $user_name);
  $user_email = mysqli_real_escape_string($conn, $user_email);
  $user_contact = mysqli_real_escape_string($conn, $user_contact);
  $user_gender = mysqli_real_escape_string($conn, $user_gender);

  $sql = "SELECT * FROM user WHERE user_email='{$user_email}' AND NOT user_id='{$user_id}'";
  $result = mysqli_query($conn, $sql);
  $row  = mysqli_fetch_array($result);
  if (is_array($row)) {
    echo '<script>alert("Email already exist!");window.location.href="staffs_edit.php?user_id=' . $user_id . '";</script>';
  } else {
    $sql = "UPDATE `user` SET user_name='{$user_name}', user_email='{$user_email}', user_contact='{$user_contact}', user_gender='{$user_gender}' WHERE user_id='{$user_id}'";
    $sqlQuery = mysqli_query($conn, $sql);

    if (!$sqlQuery) {
      die("Database connection not established. " . mysqli_error($conn));
    }
    echo '<script>alert("Staff has been updated.");window.location.href="staffs.php";</script>';
  }
}
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Staffs</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/8ag1/staffs.php">Staffs</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>

      <!-- Edit staff form -->
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa-regular fa-address-book"></i>
          Edit Staff
        </div>
        <div class="card-body">
          <form action="staffs_edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row["user_id"] ?>" />
            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="username" name="username" type="text" placeholder="Username" required value="<?php echo $row["user_name"] ?>" />
                  <label for="username">Username</label>
                </div>
              </div>
              <div class="col">
                <select class="form-select form-floating mb-3 py-3" name="gender" aria-label="Select gender" required>
                  <option disabled>Gender</option>
                  <option value="Male" <?php if ($row["user_gender"] == "Male") echo "selected"; ?>>Male</option>
                  <option value="Female" <?php if ($row["user_gender"] == "Female") echo "selected"; ?>>Female</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="email" name="email" type="email" placeholder="Email" required value="<?php echo $row["user_email"] ?>" />
                  <label for="email">Email</label>
                </div>
              </div>
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="contact" name="contact" type="text" placeholder="Contact" required value="<?php echo $row["user_contact"] ?>" />
                  <label for="contact">Contact</label>
                </div>
              </div>
            </div>


            <div class="d-flex align-items-center justify-content-start mt-4 mb-4">
              <button class="btn btn-primary btn-lg" type="submit" name="update-button">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <?php
  include 'layout/user/footer_user.php';
  ?>