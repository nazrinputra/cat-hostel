<?php
include 'layout/user/header_user.php';

$sql = "SELECT * FROM room";

$result = mysqli_query($conn, $sql);

?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Rooms</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Rooms</li>
      </ol>

      <?php
      if (mysqli_num_rows($result) == 0) {
      ?>
        <!-- No room -->
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="text-center mt-4">
              <img class="mb-4 img-error" src="assets/img/error-404-monochrome.svg" />
              <p class="lead">Looks like there is no rooms registered.</p>
              <?php
              if ($_SESSION["user_role"] == "Staff") {
              ?>
                <a href="/8ag1/rooms_add.php">
                  <i class="fa-regular fa-square-plus"></i>
                  Add a room
                </a>
              <?php
              } ?>
            </div>
          </div>
        </div>
      <?php
      } else {
      ?>
        <!-- Room table -->
        <div class="card mb-4">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <span><i class="fas fa-table me-1"></i>
                Rooms Table</span>
              <?php
              if ($_SESSION["user_role"] == "Staff") {
              ?>
                <a href="/8ag1/rooms_add.php">
                  <button type="button" class="btn btn-primary btn-sm">
                    <i class="fa-regular fa-square-plus"></i>
                    Add
                  </button>
                </a>
              <?php
              } ?>
            </div>
          </div>
          <div class="card-body">
            <table id="datatablesSimple">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                  <tr>
                    <td><?php echo $row["room_id"] ?></td>
                    <td><?php echo $row["room_name"] ?></td>
                    <td><?php echo $row["room_description"] ?></td>
                    <td>
                      <?php
                      if ($_SESSION["user_role"] == "Staff") {
                      ?>
                        <a href="/8ag1/rooms_edit.php?room_id=<?php echo $row["room_id"] ?>">
                          <button type="button" class="btn btn-primary btn-sm">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Edit
                          </button>
                        </a>
                        <a href="/8ag1/rooms_delete.php?room_id=<?php echo $row["room_id"] ?>">
                          <button type="button" class="btn btn-danger btn-sm">
                            <i class="fa-regular fa-trash-can"></i>
                            Delete
                          </button>
                        </a>
                      <?php
                      } else {
                      ?>
                        <a href="/8ag1/bookings_add.php?room_id=<?php echo $row["room_id"] ?>">
                          <button type="button" class="btn btn-primary btn-sm">
                            <i class="fa-regular fa-calendar-check"></i>
                            Book
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