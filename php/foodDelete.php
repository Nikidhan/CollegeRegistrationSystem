<?php

include_once("config.php"); // Using database connection file here

$id = $_GET['id']; // get id through query string

$sql = "DELETE FROM food WHERE foodID = '$id'";

$delete = $conn->query($sql); // delete query

if ($delete) {
    header("location:foodOrder.php?delete=success"); // redirects to all records page
} else {
    echo "Error: ".$sql."<br>".$conn->error; // display error message if not delete
}

$conn->close(); // Close connection
?>