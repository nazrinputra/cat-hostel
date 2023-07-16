<?php
include 'layout/user/header_user.php';

$sql = "SELECT * FROM user WHERE user_role='Customer'";

$result = mysqli_query($conn, $sql);

?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Customers</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Customers</li>
      </ol>

      <?php
      if (mysqli_num_rows($result) == 0) {
      ?>
        <!-- No room -->
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="text-center mt-4">
              <img class="mb-4 img-error" src="assets/img/error-404-monochrome.svg" />
              <p class="lead">Looks like there is no customers registered.</p>
              <a href="users_add.php">
                <i class="fa-regular fa-square-plus"></i>
                Add a customer
              </a>
            </div>
          </div>
        </div>
      <?php
      } else {
      ?>
        <!-- Customer table -->
        <div class="card mb-4">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <span><i class="fas fa-table me-1"></i>
                Customers Table</span>
              <a href="/customers_add.php">
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
                  <th>Contact</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row["user_id"] ?></td>
                    <td><?php echo ucwords($row["user_name"]) ?></td>
                    <td><?php echo $row["user_gender"] ?></td>
                    <td><?php echo $row["user_contact"] ?></td>
                    <td><?php echo $row["user_email"] ?></td>
                    <td><?php echo $row["user_role"] ?></td>
                    <td>
                      <?php
                      if ($row["user_active"] == true) {
                        echo 'Active';
                      } else {
                        echo 'Inactive';
                      }
                      ?>
                    </td>
                    <td>
                      <a href="/customers_edit.php?user_id=<?php echo $row["user_id"] ?>">
                        <button type="button" class="btn btn-primary btn-sm">
                          <i class="fa-regular fa-pen-to-square"></i>
                          Edit
                        </button>
                      </a>
                      <?php
                      if ($row["user_active"] == true) {
                      ?>
                        <a href="/customers_deactivate.php?user_id=<?php echo $row["user_id"] ?>">
                          <button type="button" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-toggle-off"></i>
                            Deactivate
                          </button>
                        </a>
                      <?php
                      } else {
                      ?>
                        <a href="/customers_activate.php?user_id=<?php echo $row["user_id"] ?>">
                          <button type="button" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-toggle-on"></i>
                            Activate
                          </button>
                        </a>
                      <?php
                      }
                      ?>
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