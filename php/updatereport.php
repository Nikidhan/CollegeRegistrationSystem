<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}
include_once('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") { // update a report
    if (isset($_POST['update'])) {
        $ticketNo = $_POST['ticketNo'];
        $sql ='SELECT * FROM report WHERE ticketNo="' . $ticketNo . '"';
        $result = $conn->query($sql) or die($conn->error);
        $row = $result->fetch_assoc();
        $filepath = $row['filePath'];
        if (basename($_FILES["uploadedfile"]["name"]) != "") {
            if ($filepath != "no file") {
                unlink($filepath);
            } else {
                $target_dir = "../reportupload/";
                $filetype = strtolower(pathinfo(basename($_FILES["uploadedfile"]["name"]), PATHINFO_EXTENSION)); //extension, no dot "."
                $filepath = $target_dir . $ticketNo . '.' . $filetype;
            }
            $isUploaded = move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $filepath);
        }
        $sql = 'UPDATE report SET problemDetails="'.$_POST['details'].'", mobileNum="'.$_POST['phoneNumber'].'", problemLocation="'.$_POST['location'] . '", filePath="' . $filepath . '" WHERE ticketNo="' . $ticketNo.'"';
        $result = $conn->query($sql) or die($conn->error);
        $_SESSION['report_num'] = $ticketNo;
        $_SESSION['report_status'] = 'updated';
        header('location: report.php');
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") { //delete a report
    if (isset($_POST['delete'])) {
        echo 'boss';
        $ticketNo = $_POST['delete'];
        $sql = 'SELECT * FROM report WHERE ticketNo="' . $ticketNo . '"';
        $result = $conn->query($sql) or die($conn->error);
        $row = $result->fetch_assoc();
        $filepath = $row['filePath'];
        $sql = 'DELETE FROM report WHERE ticketNo="'.$ticketNo.'"';
        $result = $conn->query($sql) or die($conn->error);
        if ($filepath!="no file") {
            unlink($filepath);
        }
        $_SESSION['report_num'] = $ticketNo;
        $_SESSION['report_status'] = 'deleted';
        header('location: report.php');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { //create new report
    if (isset($_POST["type"]) && isset($_POST['create'])) {
        echo 'hello';
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $ticketTime = date('H:i:s');
        $ticketDate = date("Y-m-d");
        //ORDER BY ticketNo DESC
        $sql = 'SELECT * FROM report WHERE ticketDate="' . $ticketDate . '" ORDER BY ticketNo DESC';
        $sql2 = 'SELECT * FROM report WHERE ticketDate="' . $ticketDate . '"';
        $result = $conn->query($sql) or die($conn->error);
        $count = $result->num_rows;

        $ticketNo = '';
        if ($count > 0) {
            $row = $result->fetch_assoc();
            $count = (int) substr($row['ticketNo'], 7);
        }
        $count = $count + 1;
        $ticketNo = substr(date("Ymd"), 2) . '-' . $count;

        $matricNo = $_SESSION['user_id'];
        $problemStatus = "Pending";
        $filepath = 'no file';
        if (basename($_FILES["uploadedfile"]["name"])!="") {
            $target_dir = "../reportupload/";
            $filetype = strtolower(pathinfo(basename($_FILES["uploadedfile"]["name"]), PATHINFO_EXTENSION)); //extension, no dot "."
            //echo 'filetype: '.$filetype;
            $filepath = $target_dir . $ticketNo . '.' . $filetype;
            $isUploaded = move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $filepath);
        }

        $sql = 'INSERT INTO report(ticketNo, matricNo, problemType, problemStatus, ticketDate, ticketTime, problemDetails, mobileNum, problemLocation, filePath) VALUES ("' . $ticketNo . '","' . $matricNo . '","' . $_POST["type"] . '","' . $problemStatus . '","' . $ticketDate .  '","' . $ticketTime . '","' . $_POST['details'] . '","' . $_POST['phoneNumber'] .  '","' . $_POST['location'] . '","' . $filepath . '")';
        $result = $conn->query($sql) or die($conn->error);
        if ($result) {
            echo "Data submitted successfully";
        }
        $conn->close();
        $_SESSION['report_num'] = $ticketNo;
        $_SESSION['report_status'] = 'created';
        header("Location: report.php"); //?action=report_success
    }
}
