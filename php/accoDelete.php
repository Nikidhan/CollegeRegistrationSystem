<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}
include_once("config.php");

$id = $_GET['id'];
$sql = "DELETE FROM room WHERE roomID = '$id'";
$del = $conn->query($sql);

if ($del) {
    $_SESSION['deleted'] = true;
    header("location:accoApplyList.php");
} else {
    echo "Error: ".$sql."<br>".$conn->error;
}
$conn->close();
