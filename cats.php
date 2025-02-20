<?php
include 'layout/user/header_user.php';

if ($_SESSION["user_role"] == "Staff") {
  $sql = "SELECT * FROM cat";
} else {
  $sql = "SELECT * FROM cat WHERE user_id='{$_SESSION["user_id"]}'";
}
$result = mysqli_query($conn, $sql);

?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Cats</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Cats</li>
      </ol>

      <?php
      if (mysqli_num_rows($result) == 0) {
      ?>
        <!-- No cat -->
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="text-center mt-4">
              <img class="mb-4 img-error" src="assets/img/error-404-monochrome.svg" />
              <p class="lead">Looks like you have no cats registered.</p>
              <a href="/cats_add.php">
                <i class="fa-regular fa-square-plus"></i>
                Add a cat
              </a>
            </div>
          </div>
        </div>
      <?php
      } else {
      ?>
        <!-- Cat table -->
        <div class="card mb-4">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <span><i class="fas fa-table me-1"></i>
                Cats Table</span>
              <a href="/cats_add.php">
                <button type="button" class="btn btn-primary btn-sm">
                  <i class="fa-regular fa-square-plus"></i>
                  Add
                </button>
              </a>
            </div>
          </div>
          <div class="card-body">
            <table id="datatablesSimple">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Color</th>
                  <th>Weight</th>
                  <th>Owner</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                  $user_id = $row['user_id'];
                  $sqlUser = "SELECT * FROM user WHERE user_id={$user_id}";
                  $resultUser = mysqli_query($conn, $sqlUser);
                  $rowUser = mysqli_fetch_array($resultUser);
                ?>
                  <tr>
                    <td><?php echo $row["cat_id"] ?></td>
                    <td><?php echo $row["cat_name"] ?></td>
                    <td><?php echo $row["cat_gender"] ?></td>
                    <td><?php echo $row["cat_color"] ?></td>
                    <td><?php echo $row["cat_weight"] ?></td>
                    <td><?php echo ucwords($rowUser["user_name"]) ?></td>
                    <td>
                      <a href="/cats_edit.php?cat_id=<?php echo $row["cat_id"] ?>">
                        <button type="button" class="btn btn-primary btn-sm">
                          <i class="fa-regular fa-pen-to-square"></i>
                          Edit
                        </button>
                      </a>
                      <a href="/cats_delete.php?cat_id=<?php echo $row["cat_id"] ?>">
                        <button type="button" class="btn btn-danger btn-sm">
                          <i class="fa-regular fa-trash-can"></i>
                          Delete
                        </button>
                      </a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
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