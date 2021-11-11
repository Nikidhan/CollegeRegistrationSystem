<?php
    session_start();
    //Step 1. Connect to the database.
    //Step 2. Handle connection errors
    //including the database connection file
    include_once("config.php");
    $matricNo = $fullname = $email = $password = $rpassword = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // do post
        //isset() will return FALSE when checking a variable that has been assigned to NULL
        if (isset($_POST["matricNo"]) && isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["rpassword"])) {
            $matricNo = $_POST["matricNo"];
            $fullname = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $rpassword = $_POST["rpassword"];
            //validate member exists or not by checking email and matric id
            //MySQLi Object-oriented approach
            //Step 3. Execute the SQL query to
            $sql = "SELECT matricNo FROM Student WHERE matricNo='".$matricNo."'";
            $sql2 = "SELECT email FROM Student WHERE email='".$email."'";
            $result = $conn->query($sql);
            $result2 = $conn->query($sql2);
            
            if ($result->num_rows >= 1) {
                $_SESSION['fail_register'] = true;
                header("location: home.php");
            //if matric number already exist
            } elseif ($result2->num_rows >= 1) {
                $_SESSION['fail_register'] = true;
                header("location: home.php");
            //if email already exist
            } elseif ($password != $rpassword) {
                $_SESSION['fail_register'] = true;
                header("location: home.php");
            //if password not match
            } else {
                //Step 3. Execute the SQL query to insert new record.
                //insert data into database's table: Student
                //Prepared Statement: Prepare, bind, execute
                $passwordh = md5(md5($password));
                $defaultprofilepicPath = "https://drive.google.com/uc?id=1_IkB8vTcFAAs-0zgapZeCRd99H3_tfaX
				&export=download";
                $stmt = $conn->prepare("INSERT INTO Student(matricNo,fullname,email,password,profilepicPath) VALUES (?, ?, ?, ?, ?)");
                // $passwordh = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param("sssss", $matricNo, $fullname, $email, $passwordh, $defaultprofilepicPath);
                
                if ($stmt->execute()) {
                    // echo "Success";
                    $_SESSION['new_register'] = true;
                    header("location: home.php");
                } else {
                    echo "Something went wrong. Please try again later.";
                }
                //Step 4. Process the results.
                $stmt->close();
            }
        }
    }
        
    //Step 5: Freeing Resources and Closing Connection using mysqli
    $conn->close();
