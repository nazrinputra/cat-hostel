<?php
include 'config/db.php';

if (!$logged_in) {
  header("Location: login.php");
  exit();
}

$room_id = $_GET['room_id'];
$sql = "DELETE FROM room WHERE room_id = '{$room_id}'";

if (mysqli_query($conn, $sql)) {
  mysqli_close($conn);
  echo '<script>alert("The room info has been deleted.");window.location.href="/8ag1/rooms.php";</script>';
  // header('Location: rooms.php');
  exit;
} else {
  echo "Error deleting record";
}
