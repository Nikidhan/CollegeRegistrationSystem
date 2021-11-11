<?php

//Step 1: Connecting to a Database using MySQLi API (Object-Oriented approach)
// modify these variables for your installation
$databaseHost = 'tviw6wn55xwxejwj.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$databaseName = 'ly2fqpu6p3clcbqm';
$databaseUsername = 'tddu6ze8y1f7vgek';
$databasePassword = 'ddecl4p6qh5liq0k';


//MySQLi Object-Oriented approach
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

//Step 2: Handling Connection Errors - mysqli
// Check connection (MySQLi object-oriented)
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Database Connected successfully";

?>

