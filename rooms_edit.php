<?php
include 'layout/user/header_user.php';

if (isset($_GET['room_id'])) {
  $room_id = $_GET['room_id'];
  $sql = "SELECT * FROM room WHERE room_id='{$room_id}'";
  $result = mysqli_query($conn, $sql);

  $row  = mysqli_fetch_array($result);
}

if (isset($_POST['update-button'])) {
  // clean data 
  $room_id = $_POST['id'];
  $room_name = stripslashes($_POST['name']);
  $room_description = stripslashes($_POST['description']);

  $room_name = mysqli_real_escape_string($conn, $room_name);
  $room_description = mysqli_real_escape_string($conn, $room_description);

  $sql = "UPDATE `room` SET room_name='{$room_name}', room_description='{$room_description}' WHERE room_id='{$room_id}'";
  $sqlQuery = mysqli_query($conn, $sql);

  if (!$sqlQuery) {
    die("Database connection not established. " . mysqli_error($conn));
  }

  echo '<script>alert("Your room info has been updated.");window.location.href="rooms.php";</script>';
}
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Rooms</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/8ag1/rooms.php">Rooms</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>

      <!-- Edit room form -->
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa-solid fa-shield-cat"></i>
          Edit Room
        </div>
        <div class="card-body">
          <form action="rooms_edit.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row["room_id"] ?>" />
            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="name" name="name" type="text" placeholder="Name" required value="<?php echo $row["room_name"] ?>" />
                  <label for="name">Name</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <textarea class="form-control" id="description" name="description" placeholder="Description">
                    <?php echo $row["room_description"] ?>
                  </textarea>
                  <label for="description">Description</label>
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