<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}

include_once("config.php");

if ($_SERVER['REQUEST_METHOD']==='POST') {

    // register
    if (isset($_POST["submit"])) {
        $matricNo = $_SESSION['user_id'];
        $project = $_POST["project"];
        $activity = $_POST["activity"];
        
        $sql = "INSERT INTO activity(matricNo, projectName, projectActivity) VALUES ('$matricNo', '$project', '$activity')";
        if ($conn->query($sql) === true) {
            echo "Inserted into database";
            $_SESSION['activityName'] = $activity;
            $_SESSION['projectName'] = $project;
            header("Location: activityReg.php");
        } else {
            echo "Error: ".$sql."<br>".$conn->error;
        }
        $conn->close();
    }
    
    // unregister
    elseif (isset($_POST["unregister"])) {
        $id = $_POST["id"];
        $sql = "DELETE FROM activity WHERE projectID = '$id'";

        if ($conn->query($sql) === true) {
            header("location:activityReg.php");
            exit;
        } else {
            echo "Error: ".$sql."<br>".$conn->error;
        }
        $conn->close();
    } else {
        echo "no submission";
    }
} else {
    echo "no post";
}
