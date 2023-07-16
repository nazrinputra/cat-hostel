<?php
include 'config/db.php';

if (!$logged_in) {
  header("Location: login.php");
  exit();
}

$user_id = $_GET['user_id'];
$sql = "UPDATE user SET user_active=false WHERE user_id = '{$user_id}'";

if (mysqli_query($conn, $sql)) {
  mysqli_close($conn);
  echo '<script>alert("The staff has been deactivated.");window.location.href="staffs.php";</script>';
  // header('Location: staffs.php');
  exit;
} else {
  echo "Error deleting record";
}
