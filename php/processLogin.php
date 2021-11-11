<?php
include_once("config.php");
session_start();

//2. validate login
if (isset($_POST['matricNo']) && isset($_POST['password'])) {
    // if the user has just tried to log in
    $user_matricNo = $_POST['matricNo'];
    $password = md5(md5($_POST['password']));
    $sql = "SELECT * FROM student WHERE matricNo='$user_matricNo' and password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // if they are in the database, register the user in session
        while ($res = $result->fetch_assoc()) {
            $userid = $res["matricNo"];
            $name = $res["fullname"];
            $email = $res["email"];
        }
        
        //registering session variables
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $userid;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;

        //redirect to dashboard.php
        header("Location: dashboard.php?");
    } else {
        //variable if log in failed
        $_SESSION['fail_login'] = true;
        header("location: home.php");
    }
}
//Freeing Resources and Closing Connection using mysqli
$conn->close();
