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
        <title>List of Accommodation Applications</title>

        <!-- Override Bootstrap CSS with custom CSS file -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/acco.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- JavaScript -->
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
                                        width="30" height="30" class="rounded-circle" alt="default-pic">
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
                <h1 class="display-4">Accommodation Applications</h1>
            </div>
        </header>
        <main>
            <div class="container" style="width: 1000px;">
                <?php
                if (isset($_SESSION['deleted'])) {
                    echo "<div class=\"justify-content-center text-center\"><p class=\"alert alert-danger mx-auto p-2\" style=\"width:30%;\">Application deleted succesfully.</p></div>";
                    unset($_SESSION['deleted']);
                }
                if (isset($_SESSION['empty_text'])) {
                    echo "<div class=\"justify-content-center text-center\"><p class=\"alert alert-warning mx-auto mb-0 p-2\" style=\"width:30%;\">Update failed. No reason provided. </p></div>";
                    unset($_SESSION['empty_text']);
                }
                ?>
                <table class="table text-center m-0 p-0">
                    <tr class="text-center">
                        <th style="width: 125px;">Check In</th>
                        <th style="width: 125px;">Check Out</th>
                        <th style="width: 90px;">Duration</th>
                        <th style="width: 140px;">Rental (RM)</th>
                        <th style="width: 200px;">Reason</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 110px;">Room</th>
                        <th style="width: 110px;">Operation</th>
                    </tr>
                    
                    <?php
                    $matricNo = $_SESSION['user_id'];
                    $sql = "SELECT * FROM room WHERE matricNo = '$matricNo' ORDER BY roomID DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $roomID = $row['roomID'];
                            $checkIn = $row['checkIn'];
                            $checkOut = $row['checkOut'];
                            $duration = $row['duration'];
                            $rental =$row['rental'];
                            $reason = $row['reason'];
                            $status = $row['roomStatus'];
                            $roomNo = $row['roomNo']; ?>

                    <tr class="text-center">
                        <td><?php echo $checkIn; ?></td>
                        <td><?php echo $checkOut; ?></td>
                        <td><?php echo $duration; ?></td>
                        <td><?php echo $rental; ?></td>
                        <td class="text-lowercase"><?php echo $reason; ?></td>
                        
                        <?php if ($status=="Submitted") { ?>
                        <td class="text-capitalize alert alert-warning"><?php echo $status; ?></td>
                        <td class="text-uppercase"><?php echo $roomNo; ?></td>
                        <td class="text-center">
                            <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Edit">
                                <a href="#" data-toggle='modal' data-target='#updateModal_<?php  echo $roomID; ?>'><i class="fa fa-pencil" style="color:#7289da;" aria-hidden="true"></i></a>
                            </span>

                            <!-- update Modal -->
                            <div class="modal fade" id="updateModal_<?php echo $roomID; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update application</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <form name="formAcco" action="accoProcess.php" method="POST">
                                        <div class="modal-body">
                                        
                                            <div class="form-group row">
                                                <div class="col-8"><input type="hidden" name="roomid" value="<?php echo $roomID; ?>"/></div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="checkIn" class="col-4 col-form-label text-right">Check In Date</label>
                                                <div class="col-7">
                                                    <input class="form-control" type="date" id="checkIn" name="checkIn" min="2020-07-01"
                                                        max="2020-08-31" onchange="getDate()" value="<?php echo $checkIn; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="checkOut" class="col-4 col-form-label text-right">Check Out Date</label>
                                                <div class="col-7">
                                                    <input class="form-control" type="date" id="checkOut" name="checkOut" min="2020-07-01"
                                                        max="2020-08-31" value="<?php echo $checkOut; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="reason" class="col-4 col-form-label text-right">Reason</label>
                                                <div class="col-7">
                                                    <textarea class="form-control p-2 ml-0" type="text" id="reason" name="reason" value="<?php echo $reason; ?>" required><?php echo $reason; ?></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <div class="submitForm" style="text-align: center;">
                                                <input type="submit" class="button" name="update" value="Update"/>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            &nbsp;&nbsp;
                            
                            <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Delete">
                                <a href="#" data-toggle='modal' data-target='#deleteModal_<?php  echo $roomID; ?>'><i class="fa fa-trash-o" style="color:#7289da;" aria-hidden="true"></i></a>
                            </span>
                            
                            <!-- delete Modal -->
                            <div class="modal fade" id="deleteModal_<?php  echo $roomID; ?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete application</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete your application?<br><br>
                                            Check In:&nbsp;<?php echo $checkIn; ?><br>
                                            Check Out:&nbsp;<?php echo $checkOut; ?><br>
                                            Reason:&nbsp;<?php echo $reason; ?><br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="accoDelete.php?id=<?php echo $roomID; ?>" type="submit" name="unregister" class="btn btn-danger">Proceed</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                <br>
                <?php
                            } elseif ($status=="Rejected") {
                                echo "<td class=\"text-capitalize alert alert-danger\">$status</td>
                                        <td class=\"text-uppercase\">$roomNo</td>
                                        <td></td>";
                            } elseif ($status=="Approved") {
                                echo "<td class=\"text-capitalize alert alert-success\">$status</td>
                                        <td class=\"text-uppercase\">$roomNo</td>
                                        <td></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                    $sql1 = "SELECT * FROM room WHERE `matricNo` = '$matricNo' AND `roomStatus` = 'submitted'";
                    $result1 = $conn->query($sql1) or die($conn->error);
                    if ($result1->num_rows > 0) {
                        echo "&nbsp<div style=\"text-align: center;\">
                        <input type=\"button\" class=\"buttondisable\" style=\"
                        background-color: #eee;
                        color: #bbb;
                        text-decoration: none;
                        display: inline-block;
                        padding: 5px;
                        border: 1px solid #eee;
                        border-radius: 0.3rem;\" value=\"Add New Application\" disabled>
                        </div>";
                    } else {
                        echo "&nbsp<div style=\"text-align: center;\">
                        <a href=\"accoApply.php\"><input type=\"button\" class=\"button\" value=\"Add New Application\"></a>    
                        </div>";
                    }
                    $conn->close();
                ?>   
                <br><br>
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
            
            $(function () {
                $('[data-toggle="popover"]').popover({
                    placement: 'top',
                    trigger: 'hover'
                });
            });
        </script>
        <script type="text/JavaScript">
        function viewApplication() {
            window.location.assign("accoApplyList.php")
        }

        document.getElementById("checkIn").addEventListener("load", getDate());
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