<?php

	session_start();
	if (!isset($_SESSION['logged_in'])) {
		session_destroy();
		header('location: nologin.php');
	}
	include_once("config.php");
    
	$user_email = $_SESSION['user_email'];
	

    if(isset($_POST['update']))
    {	
        //The mysqli_real_escape_string() function escapes special characters in a string for use in an SQL statement.
		$newname = $_POST['name'];
		$newicNum = $_POST['ic_num'];
		$newgender = $_POST['gender'];
		$newrace = $_POST['race'];
		$newbirthdate = $_POST['birthdate'];
		$newaddress = $_POST['address'];
		$newlevelStudy = $_POST['levelStudy'];
		$newfaculty = $_POST['faculty'];
		$newsemester = $_POST['semester'];
		$newprogramme = $_POST['programme'];
		$newdisability = $_POST['disability'];
		$newdisabilityStatus = $_POST['disabilityDetail'];
		$newroom = $_POST['room'];
		$newpassword = $_POST['password'];
		$passwordh = md5(md5($newpassword));
		// $passwordh = $newpassword;


    	// checking empty fields
    	if(empty($newname)) {	
                
    		if(empty($newname)) {
    			echo "<font color='red'>Name field is empty.</font><br/>";
			}
			if(empty($newdisabilityStatus)){
				$disabilityStatus="Not applicable";
			}
			
			
    	} else {
    		//Step 3. Execute the SQL query.
    		//updating the table
			//Prepared Statement: Prepare, bind, execute
			if(empty($newdisabilityStatus)){
				$newdisabilityStatus="Not applicable";
			}
    		$sql2 = "UPDATE student SET fullname=?, icNum=?, gender=?, race=?, birthdate=?, address=?, levelStudy=?, faculty=?, programme=?, disability=?, disabilityStatus=?, roomNo=?, password=?, semester=? WHERE email=?";
    		$stmt = $conn->prepare($sql2);
    		$stmt->bind_param("sssssssssssssss",$newname,$newicNum,$newgender,$newrace,$newbirthdate,$newaddress,$newlevelStudy,$newfaculty,$newprogramme,$newdisability,$newdisabilityStatus,$newroom,$passwordh,$newsemester,$user_email);
    		$stmt->execute();
            
    		//redirectig to the display page. In our case, it is index.php
    		header("Location: manage.php");
            
    		//Step 5: Freeing Resources and Closing Connection using mysqli
            $stmt->close();
            $conn->close();
    	}
    }

?>

