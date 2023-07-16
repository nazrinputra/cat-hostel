<?php
include 'config/db.php';

if (!$logged_in) {
  header("Location: login.php");
  exit();
}

$user_id = $_GET['user_id'];
$sql = "UPDATE user SET user_active=true WHERE user_id = '{$user_id}'";

if (mysqli_query($conn, $sql)) {
  mysqli_close($conn);
  echo '<script>alert("The customer has been activated.");window.location.href="/8ag1/customers.php";</script>';
  // header('Location: customers.php');
  exit;
} else {
  echo "Error deleting record";
}
