<?php
    session_start();
	if (!isset($_SESSION['logged_in'])) {
		session_destroy();
		header('location: nologin.php');
	}
	include_once("config.php");
    
    $userid = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $password = $_POST['deletePassword'];
    $passwordh= md5(md5($password));
    $sql = "SELECT * FROM student WHERE matricNo='$userid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($res = $result->fetch_assoc()) {
            $realpassword = $res["password"];
            $profilepicPath = $res["profilepicPath"];
        }
    }
    
    if($passwordh==$realpassword){
        $sql1 = "DELETE FROM activity WHERE matricNo = '$userid'";
        $del1 = $conn->query($sql1); // delete query

        $sql2 = "DELETE FROM food WHERE matricNo = '$userid'";
        $del2 = $conn->query($sql2); // delete query

        $sql3 = "DELETE FROM report WHERE matricNo = '$userid'";
        $del3 = $conn->query($sql3); // delete query

        $sql4 = "DELETE FROM room WHERE matricNo = '$userid'";
        $del4 = $conn->query($sql4); // delete query

        if($profilepicPath == "https://drive.google.com/uc?id=1_IkB8vTcFAAs-0zgapZeCRd99H3_tfaX
            &export=download"){
            echo "This is default path";
        }else{
            $result = unlink($profilepicPath);
            if($result){
                echo "Profile pic has been deleted";
            }else{
                echo "Error while deleting profile pic";
            }
        }

        if($del1 && $del2 && $del3 && $del4){
            $sql5 = "DELETE FROM student WHERE matricNo = '$userid'";
            $del5 = $conn->query($sql5); // delete query
            header('location: logout.php');
            $conn->close();
        }else{
            echo "Error: ".$sql1."<br>".$conn->error;
            echo "Error: ".$sql2."<br>".$conn->error;
            echo "Error: ".$sql3."<br>".$conn->error;
            echo "Error: ".$sql4."<br>".$conn->error;
        }
        
        $conn->close();

    }else{
        echo "<p>Error: Wrong password</p>";
        echo "<a href='manage.php'>Back to profile</a>";
    }

    
}


?>