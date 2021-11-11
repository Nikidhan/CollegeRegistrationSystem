<?php
session_start();
include_once("config.php");
if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}

$user_email = $_SESSION['user_email'];

$sql = "SELECT * FROM student WHERE email='$user_email'";
$result = $conn->query($sql);

if ($result->num_rows>0){
    while($res = $result->fetch_assoc()) {
        $user_id = $res['matricNo'];
    }
}

if(isset($_POST['submit'])){
    $filepath = "";
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileExtension = explode('.',$fileName);
    $fileActExtension = strtolower(end($fileExtension));

    $allowed = array ('jpg','png','jpeg');

    if (in_array($fileActExtension,$allowed)){
        if ($fileError ===0){
            if ($fileSize<4000000){
                $fileNameNew = $user_id."."."$fileActExtension";
                $fileDestination = 'upload/'.$fileNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                $filepath = "upload/".$user_id.".".$fileActExtension;
                $sql = "UPDATE student SET profilepicPath=? WHERE email=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss",$filepath,$user_email);
                $stmt->execute();
                
                header("Location: update_details.php?uploadsuccess");

                $stmt->close();
                $conn->close();

            }else{
                
                header("Location: update_details.php?uploadfailed:sizeTooLarge");
            }
        }else{   
            
            header("Location: update_details.php?uploadfailed:fileError");
        }
    }else{
        header("Location: update_details.php?uploadfailed:filetypeError");
    }

}

?>