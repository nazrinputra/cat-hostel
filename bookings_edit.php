<?php
include 'layout/user/header_user.php';

if (isset($_GET['room_id'])) {
  $room_id = $_GET['room_id'];
} else {
  $room_id = "";
}

$sqlRoom = "SELECT * FROM room";
$resultRoom = mysqli_query($conn, $sqlRoom);

if ($_SESSION["user_role"] == "Staff") {
  $sqlCat = "SELECT * FROM cat";
} else {
  $sqlCat = "SELECT * FROM cat WHERE user_id='{$_SESSION["user_id"]}'";
}
$resultCat = mysqli_query($conn, $sqlCat);

if (isset($_GET['booking_id'])) {
  $booking_id = $_GET['booking_id'];
  $sql = "SELECT * FROM booking WHERE booking_id='{$booking_id}'";
  $result = mysqli_query($conn, $sql);

  $row  = mysqli_fetch_array($result);
}

if (isset($_POST['update-button'])) {
  // clean data
  $booking_id = $_POST['id'];
  $room_id = stripslashes($_POST['room_id']);
  $cat_id = stripslashes($_POST['cat_id']);
  $check_in = stripslashes($_POST['check_in']);
  $check_out = stripslashes($_POST['check_out']);

  $room_id = mysqli_real_escape_string($conn, $room_id);
  $cat_id = mysqli_real_escape_string($conn, $cat_id);
  $check_in = mysqli_real_escape_string($conn, $check_in);
  $check_out = mysqli_real_escape_string($conn, $check_out);

  $sql = "UPDATE `booking` SET room_id='{$room_id}', cat_id='{$cat_id}', check_in='{$check_in}', check_out='{$check_out}' WHERE booking_id='{$booking_id}'";
  $sqlQuery = mysqli_query($conn, $sql);

  if (!$sqlQuery) {
    die("Database connection not established. " . mysqli_error($conn));
  }

  echo '<script>alert("Your booking info has been updated.");window.location.href="bookings.php";</script>';
}
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Bookings</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/bookings.php">Bookings</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>

      <!-- Edit booking form -->
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa-regular fa-calendar-check"></i>
          Edit Booking
        </div>
        <div class="card-body">
          <form action="bookings_edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row["booking_id"] ?>" />
            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="booking_reference" name="booking_reference" type="text" placeholder="Reference" value="<?php echo $row["booking_reference"] ?>" readonly />
                  <label for="booking_reference">Reference</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <select class="form-select form-floating mb-3 py-3" name="room_id" aria-label="Select Room">
                    <option selected>Select Room</option>
                    <?php
                    while ($rowRoom  = mysqli_fetch_array($resultRoom)) {
                    ?>
                      <option value="<?php echo $rowRoom["room_id"] ?>" <?php if ($row["room_id"] == $rowRoom["room_id"]) echo "selected"; ?>>
                        <?php echo $rowRoom["room_name"] ?>
                      </option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <select class="form-select form-floating mb-3 py-3" name="cat_id" aria-label="Select Cat">
                    <option selected>Select Cat</option>
                    <?php
                    while ($rowCat  = mysqli_fetch_array($resultCat)) {
                    ?>
                      <option value="<?php echo $rowCat["cat_id"] ?>" <?php if ($row["cat_id"] == $rowCat["cat_id"]) echo "selected"; ?>>
                        <?php echo $rowCat["cat_name"] ?>
                      </option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="check_in" name="check_in" type="date" placeholder="Check In" value="<?php echo $row["check_in"] ?>" />
                  <label for="check_in">Check In</label>
                </div>
              </div>
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="check_out" name="check_out" type="date" placeholder="Check Out" value="<?php echo $row["check_out"] ?>" />
                  <label for="check_out">Check Out</label>
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