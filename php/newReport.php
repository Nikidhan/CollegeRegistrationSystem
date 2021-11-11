<?php

include_once('config.php');
session_start();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   if (isset($_POST["type"])) {
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $ticketTime = date('H:i:s');
    $ticketDate = date("Y-m-d");
    //ORDER BY ticketNo DESC
    $sql = 'SELECT * FROM report WHERE ticketDate="' . $ticketDate . '" ORDER BY ticketNo DESC';
    $sql2 = 'SELECT * FROM report WHERE ticketDate="' . $ticketDate . '"';
    $result = $conn->query($sql) or die($conn->error);
    $count = $result->num_rows;

    $ticketNo = '';
    if($count>0){
      $row = $result->fetch_assoc();
      $count = (int) substr($row['ticketNo'], 7);
    
    }
    $count = $count+1;
    $ticketNo = substr(date("Ymd"), 2) . '-'.$count;
    
    $matricNo = $_SESSION['user_id'];
    $problemType = $_POST["type"];
    $problemStatus = "New";
    
    $sql = 'INSERT INTO report(ticketNo, matricNo, problemType, problemStatus, ticketDate, ticketTime) VALUES ("'.$ticketNo. '","' . $matricNo . '","' . $problemType . '","' . $problemStatus . '","' . $ticketDate .  '","' . $ticketTime . '")';
    $result = $conn->query($sql) or die($conn->error);
    if($result){
      echo "Data submitted successfully";
    }
    $conn->close();
    $_SESSION['new_report'] = true;
    header("Location: report.php"); //?action=report_success
//   }
// }

// $noDate = substr(date("Ymd"), 2);
// $count = 2;
// $ticketNo = $noDate . '-' . $count;
// echo $ticketNo;

?>
