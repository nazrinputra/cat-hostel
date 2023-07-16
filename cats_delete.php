<?php
include 'config/db.php';

if (!$logged_in) {
  header("Location: login.php");
  exit();
}

$cat_id = $_GET['cat_id'];
$sql = "DELETE FROM cat WHERE cat_id = '{$cat_id}'";

if (mysqli_query($conn, $sql)) {
  mysqli_close($conn);
  echo '<script>alert("The cat info has been deleted.");window.location.href="cats.php";</script>';
  // header('Location: cats.php');
  exit;
} else {
  echo "Error deleting record";
}
