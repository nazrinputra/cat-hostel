<?php
include 'config/db.php';

if ($logged_in) {
  header("Location: index.php");
  exit();
}
