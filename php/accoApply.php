<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}
include_once("config.php");
$user_id= $_SESSION['user_id'];
$sql = "SELECT * FROM student WHERE matricNo='$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($res = $result->fetch_assoc()) {
        $profilepicPath = $res["profilepicPath"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Accommodation Application</title>

        <!-- Override Bootstrap CSS with custom CSS file -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/acco.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- jQuery -->
        <script>
            $(window).scroll(function () {
                $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
            });
        </script>
    </head>
    <body>
        <header>
            <div class="jumbotron text-center">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-0">
                    <a class="navbar-brand" href="#">
                        <img src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download"
                            width="40" height="40" alt="kk8 logo"></a>
                    <!-- This button appear at the navbar when the user make the browser smaller -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- 	This navbar dissapear when the user make the browser smaller -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <!-- Items in the navbar can be included in the list -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="activityList.php">Activities</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="foodOrder.php">Food</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="accoApply.php">Accommodation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="report.php">Report</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo $profilepicPath ?>"
                                            width="30" height="30" class="rounded-circle" alt="default-pic" style="object-fit:cover;">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="manage.php">Manage Profile</a>
                                        <a class="dropdown-item" href="logout.php">Log Out</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <br><br>
                <h1 class="display-4">Room Accommodation</h1>
                <p class="lead">Apply for accommodation during semester break</p>
            </div>
        </header>
        <main>
            <div class="container col-5" style="width: 1000px;">
                <p class="alert alert-info text-center p-1 center-block"><small>Note: RM6.50 will be charged per day.</small></p>
                <?php

                if (isset($_SESSION['empty_text'])) {
                    echo "<p class=\"text-center\" style=\"color: red;\">Please fill in your reason.</p>";
                    unset($_SESSION['empty_text']);
                }
                
                $matricNo = $_SESSION['user_id'];
                $sql = "SELECT * FROM room WHERE matricNo = '$matricNo' AND roomStatus = 'submitted'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $disable = 'disabled';
                    $style = 'style="background-color: #eee; color: #bbb; text-decoration: none; display: inline-block; padding: 5px; border: 1px solid #eee; border-radius: 0.3rem;"';
                } else {
                    $disable = 'required';
                    $style = '';
                }
                
                ?>
                <form name="formAcco" action="accoProcess.php" method="POST">
                    <div class="form-group row">
                        <label for="checkIn" class="col-3 col-form-label text-right">Check In Date</label>
                        <div class="col-8">
                            <input class="form-control" type="date" id="checkIn" name="checkIn" min="2020-07-01"
                                max="2020-08-31" onchange="getDate()" <?php echo $disable;?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="checkOut" class="col-3 col-form-label text-right">Check Out Date</label>
                        <div class="col-8">
                            <input class="form-control" type="date" id="checkOut" name="checkOut" min="2020-07-01"
                                max="2020-08-31" <?php echo $disable;?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reason" class="col-3 col-form-label text-right">Reason</label>
                        <div class="col-9">
                            <textarea class="form-control p-2 ml-0" type="text" id="reason" name="reason" <?php echo $disable;?>></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="submitForm" style="text-align: center;">
                        <input type="submit" name="submit" value="Submit &raquo;" class="button" <?php echo $style, $disable;?>/>
                        &nbsp;
                        <input type="button" value="View Application" onclick="viewApplication()" class="button" />
                    </div>
                </form>
            </div>
        </main>
        <br><br>
        <footer class="container-fluid px-2 px-sm-5 py-auto">
            <div class="d-flex flex-column flex-sm-row text-light font-italic">
                <div class="py-1 ml-sm-0 text-center">
                    Copyright © 2020 - Kinabalu Residential College,&nbsp;<a class="text-light text-nowrap ml-sm-0"
                        data-toggle="tooltip" data-placement="top" href="https://www.um.edu.my/" title="um.edu.my"><u>
                            University
                            of Malaya</u>
                    </a>.
                </div>
                <div class="mx-auto mr-sm-0 pt-sm-1 pb-2 pb-sm-0">
                    <a tabindex="0" class="text-light" data-toggle="tooltip" data-placement="top"
                        href="https://www.instagram.com/unimalaya/" title="@unimalaya"><i
                            class="px-2 fa fa-instagram fa-lg"></i></a><a tabindex="0" class="text-light"
                        data-toggle="tooltip" data-placement="top" href="https://twitter.com/unimalaya/"
                        title="@unimalaya"><i class="px-2 fa fa-twitter fa-lg"></i></a>
                </div>
            </div>
        </footer>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>
        <script type="text/JavaScript">
            function viewApplication() {
                window.location.assign("accoApplyList.php")
            }

            function getDate(){
                x = document.getElementById('checkIn').value;
                console.log(document.getElementById('checkIn').value);

                var nextDate = new Date(x);
                nextDate.setDate(nextDate.getDate()+1);
                var result = formatDate(nextDate); 
                console.log(result);
                
                document.getElementById('checkOut').setAttribute("min", result);
            }

            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            }
        </script>
    </body>
</html>