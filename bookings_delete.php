<?php
include 'config/db.php';

if (!$logged_in) {
  header("Location: login.php");
  exit();
}

$booking_id = $_GET['booking_id'];
$sql = "DELETE FROM booking WHERE booking_id = '{$booking_id}'";

if (mysqli_query($conn, $sql)) {
  mysqli_close($conn);
  echo '<script>alert("Your booking info has been deleted.");window.location.href="bookings.php";</script>';
  // header('Location: bookings.php');
  exit;
} else {
  echo "Error deleting record";
}
