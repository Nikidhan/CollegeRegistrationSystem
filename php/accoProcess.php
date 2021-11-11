<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}

include_once("config.php");

if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (isset($_POST['submit'])) {
        if (isset($_POST["checkIn"]) && isset($_POST["checkOut"]) && !empty($_POST["reason"])) {
            // validate reason is not empty space
            if ($_POST["reason"]!=" ") {
                $matricNo = $_SESSION['user_id'];
                $checkIn = $_POST["checkIn"];
                $checkOut = $_POST["checkOut"];
                $reason = $_POST["reason"];

                function rent($checkIn, $checkOut)
                {
                    $start_date = strtotime($checkIn);
                    $end_date = strtotime($checkOut);
                    $duration = ($end_date-$start_date)/60/60/24;
        
                    return $duration;
                }

                $duration = rent($checkIn, $checkOut);
                $rental = 6.5*$duration;
                $status = "Submitted";
                $roomNo = "-";
                
                // insert into table
                $sql = "INSERT INTO room(matricNo, checkIn, checkOut, duration, rental, reason, roomStatus, roomNo) VALUES ('$matricNo', '$checkIn', '$checkOut', $duration, $rental, '$reason', '$status','$roomNo')";
                $stmt = $conn->query($sql);
                if ($stmt === true) {
                    echo "New record created successfully";
                    header("Location: accoApplyList.php");
                } else {
                    echo "Error: ".$sql."<br>".$conn->error;
                }
                $conn->close();
            } else {
                $_SESSION['empty_text'] = true;
                header("Location: accoApply.php");
            }
        }
    } // post == submit
    elseif (isset($_POST['update'])) {
        if (isset($_POST["roomid"]) && isset($_POST["checkIn"]) && isset($_POST["checkOut"]) && !empty($_POST["reason"])) {
            if ($_POST["reason"]!=" ") {
                $roomid = $_POST["roomid"];
                $checkIn = $_POST["checkIn"];
                $checkOut = $_POST["checkOut"];
                $reason = $_POST["reason"];

                function rent($checkIn, $checkOut)
                {
                    $start_date = strtotime($checkIn);
                    $end_date = strtotime($checkOut);
                    $duration = ($end_date-$start_date)/60/60/24;
                
                    return $duration;
                }

                $duration = rent($checkIn, $checkOut);
                $rental = 6.5*$duration;
                
                $sql = "UPDATE room SET checkIn = ?, checkOut = ?, duration = ?, rental = ?, reason  = ? WHERE roomID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssss", $checkIn, $checkOut, $duration, $rental, $reason, $roomid);
                $stmt->execute();
                if ($stmt->execute() === true) {
                    echo "Updated successfully";
                    header("Location: accoApplyList.php");
                } else {
                    echo "Error: ".$sql."<br>".$conn->error;
                }
                $conn->close();
            } else {
                $_SESSION['empty_text'] = true;
                header("Location: accoApplyList.php");
            }
        }
    }// post == update
} // server == post
