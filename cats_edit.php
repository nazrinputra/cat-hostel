<?php
include 'layout/user/header_user.php';

if (isset($_GET['cat_id'])) {
  $cat_id = $_GET['cat_id'];
  $sql = "SELECT * FROM cat WHERE cat_id='{$cat_id}'";
  $result = mysqli_query($conn, $sql);

  $row  = mysqli_fetch_array($result);
}

if (isset($_POST['update-button'])) {
  // clean data
  $cat_id = $_POST['id'];
  $cat_name = stripslashes($_POST['name']);
  $cat_color = stripslashes($_POST['color']);
  $cat_weight = stripslashes($_POST['weight']);
  $cat_gender = stripslashes($_POST['gender']);

  $cat_name = mysqli_real_escape_string($conn, $cat_name);
  $cat_color = mysqli_real_escape_string($conn, $cat_color);
  $cat_weight = mysqli_real_escape_string($conn, $cat_weight);
  $cat_gender = mysqli_real_escape_string($conn, $cat_gender);

  $sql = "UPDATE `cat` SET cat_name='{$cat_name}', cat_color='{$cat_color}', cat_weight='{$cat_weight}', cat_gender='{$cat_gender}' WHERE cat_id='{$cat_id}'";
  $sqlQuery = mysqli_query($conn, $sql);

  if (!$sqlQuery) {
    die("Database connection not established. " . mysqli_error($conn));
  }

  echo '<script>alert("Your cat info has been updated.");window.location.href="/8ag1/cats.php";</script>';
}
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Cats</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/8ag1/cats.php">Cats</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>

      <?php
      if (is_array($row)) {
      ?>
        <!-- Edit cat form -->
        <div class="card mb-4">
          <div class="card-header">
            <i class="fa-solid fa-cat"></i>
            Edit Cat
          </div>
          <div class="card-body">
            <form action="cats_edit.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $row["cat_id"] ?>" />
              <div class="row">
                <div class="col">
                  <div class="form-floating mb-3">
                    <input class="form-control" id="name" name="name" type="text" placeholder="Name" required value="<?php echo $row["cat_name"] ?>" />
                    <label for="name">Name</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-floating mb-3">
                    <input class="form-control" id="color" name="color" type="text" placeholder="Color" required value="<?php echo $row["cat_color"] ?>" />
                    <label for="color">Color</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-floating mb-3">
                    <input class="form-control" id="weight" name="weight" type="text" placeholder="Weight" required value="<?php echo $row["cat_weight"] ?>" />
                    <label for="weight">Weight</label>
                  </div>
                </div>
                <div class="col">
                  <select class="form-select form-floating mb-3 py-3" name="gender" aria-label="Select gender" required>
                    <option disabled>Gender</option>
                    <option value="Male" <?php if ($row["cat_gender"] == "Male") echo "selected"; ?>>Male</option>
                    <option value="Female" <?php if ($row["cat_gender"] == "Female") echo "selected"; ?>>Female</option>
                  </select>
                </div>
              </div>


              <div class="d-flex align-items-center justify-content-start mt-4 mb-4">
                <button class="btn btn-primary btn-lg" type="submit" name="update-button">Update</button>
              </div>
            </form>
          </div>
        </div>
      <?php
      } else {
      ?>
        <!-- No cat -->
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="text-center mt-4">
              <img class="mb-4 img-error" src="assets/img/error-404-monochrome.svg" />
              <p class="lead">The cat associated with this id is not found.</p>
              <a href="cats_add.php">
                <i class="fa-regular fa-square-plus"></i>
                Add a cat
              </a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </main>

  <?php
  include 'layout/user/footer_user.php';
  ?>