<?php
include 'layout/user/header_user.php';

if (isset($_POST['save-button'])) {
  // clean data 
  $cat_name_register = stripslashes($_POST['name']);
  $cat_color_register = stripslashes($_POST['color']);
  $cat_weight_register = stripslashes($_POST['weight']);
  $cat_gender_register = stripslashes($_POST['gender']);

  $cat_name_register = mysqli_real_escape_string($conn, $cat_name_register);
  $cat_color_register = mysqli_real_escape_string($conn, $cat_color_register);
  $cat_weight_register = mysqli_real_escape_string($conn, $cat_weight_register);
  $cat_gender_register = mysqli_real_escape_string($conn, $cat_gender_register);

  $sql = "INSERT into `cat` (cat_name, cat_color, cat_weight, cat_gender, user_id) VALUES ('{$cat_name_register}', '{$cat_color_register}', '{$cat_weight_register}', '{$cat_gender_register}', '{$_SESSION["user_id"]}')";
  $sqlQuery = mysqli_query($conn, $sql);

  if (!$sqlQuery) {
    die("Database connection not established. " . mysqli_error($conn));
  }

  echo '<script>alert("Your cat info has been added.");window.location.href="/cats.php";</script>';
}
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Cats</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/cats.php">Cats</a></li>
        <li class="breadcrumb-item active">Add</li>
      </ol>

      <!-- Add cat form -->
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa-solid fa-cat"></i>
          Add Cat
        </div>
        <div class="card-body">
          <form action="cats_add.php" method="POST">
            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="name" name="name" type="text" placeholder="Name" required />
                  <label for="name">Name</label>
                </div>
              </div>
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="color" name="color" type="text" placeholder="Color" required />
                  <label for="color">Color</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="weight" name="weight" type="text" placeholder="Weight" required />
                  <label for="weight">Weight</label>
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