<?php
include 'layout/user/header_user.php';

if ($_SESSION["user_role"] == "Staff") {
  $sql = "SELECT * FROM booking";
} else {
  $sqlCat = "SELECT cat_id FROM cat WHERE user_id='{$_SESSION["user_id"]}'";
  $resultCat = mysqli_query($conn, $sqlCat);
  $rowCat  = mysqli_fetch_array($resultCat);

  if ($rowCat) {
    $sql = "SELECT * FROM booking WHERE cat_id IN (" . implode(',', array_map('intval', $rowCat)) . ")";
    $result = mysqli_query($conn, $sql);
  } else {
    $result = null;
  }
}
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Bookings</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Bookings</li>
      </ol>

      <?php
      if (!$result || mysqli_num_rows($result) == 0) {
      ?>
        <!-- No room -->
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="text-center mt-4">
              <img class="mb-4 img-error" src="assets/img/error-404-monochrome.svg" />
              <p class="lead">Looks like there is no bookings in the system.</p>

              <a href="/bookings_add.php">
                <i class="fa-regular fa-calendar-check"></i>
                Book a room
              </a>
            </div>
          </div>
        </div>
      <?php
      } else {
      ?>
        <!-- Booking table -->
        <div class="card mb-4">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <span><i class="fas fa-table me-1"></i>
                Bookings Table</span>
              <a href="/bookings_add.php">
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
                  <th>Reference</th>
                  <th>Room</th>
                  <th>Cat</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                  $sqlRoom = "SELECT * FROM room WHERE room_id={$row["room_id"]}";
                  $resultRoom = mysqli_query($conn, $sqlRoom);
                  $rowRoom = mysqli_fetch_array($resultRoom);

                  $sqlCat = "SELECT * FROM cat WHERE cat_id={$row["cat_id"]}";
                  $resultCat = mysqli_query($conn, $sqlCat);
                  $rowCat = mysqli_fetch_array($resultCat);
                ?>
                  <tr>
                    <td><?php echo $row["booking_reference"] ?></td>
                    <td><?php echo $rowRoom["room_name"] ?></td>
                    <td><?php echo $rowCat["cat_name"] ?></td>
                    <td><?php echo $row["check_in"] ?></td>
                    <td><?php echo $row["check_out"] ?></td>
                    <td>
                      <a href="/bookings_edit.php?booking_id=<?php echo $row["booking_id"] ?>">
                        <button type="button" class="btn btn-primary btn-sm">
                          <i class="fa-regular fa-pen-to-square"></i>
                          Edit
                        </button>
                      </a>
                      <a href="/bookings_delete.php?booking_id=<?php echo $row["booking_id"] ?>">
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