<?php
require_once("config.php");


if(!empty($_POST["matricNo"])) {
  // $username = $_POST["username"];
  $sql = "SELECT * FROM student WHERE matricNo='" . $_POST["matricNo"] . "'";
  $user_count = $conn->query($sql)->num_rows;
  if ($user_count>0) {
    echo 0; //"<span class='status-not-available'> Matric number already registered.</span>";
  } else {
      echo 1; //"<span class='status-available'> Matric number available.</span>";
  }

}
if(!empty($_POST["email"])) {
  // $username = $_POST["username"];
  $sql = "SELECT * FROM student WHERE email='" . $_POST["email"] . "'";
  $user_count = $conn->query($sql)->num_rows;
  if ($user_count>0) {
    echo 0; //"<span class='status-not-available'> Siswamail already registered.</span>";
  } else {
      echo 1; //echo "<span class='status-available'> Siswamail available.</span>";
  }

}
?>