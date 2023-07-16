<?php
include 'layout/user/header_user.php';

if (isset($_POST['save-button'])) {
  // clean data 
  $room_name_register = stripslashes($_POST['name']);
  $room_description_register = stripslashes($_POST['description']);

  $room_name_register = mysqli_real_escape_string($conn, $room_name_register);
  $room_description_register = mysqli_real_escape_string($conn, $room_description_register);

  $sql = "INSERT into `room` (room_name, room_description) VALUES ('{$room_name_register}', '{$room_description_register}')";
  $sqlQuery = mysqli_query($conn, $sql);

  if (!$sqlQuery) {
    die("Database connection not established. " . mysqli_error($conn));
  }

  echo '<script>alert("Your room info has been added.");window.location.href="rooms.php";</script>';
}
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Rooms</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/rooms.php">Rooms</a></li>
        <li class="breadcrumb-item active">Add</li>
      </ol>

      <!-- Add room form -->
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          Add Room
        </div>
        <div class="card-body">
          <form action="rooms_add.php" method="POST">
            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <input class="form-control" id="name" name="name" type="text" placeholder="Name" />
                  <label for="name">Name</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-floating mb-3">
                  <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                  <label for="description">Description</label>
                </div>
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