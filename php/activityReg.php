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
$date = new DateTime();
$today = $date->format('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Activity Registration</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../css/activity.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script>
            $(window).scroll(function () {
                $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>
    </head>
    <body>
        <header>
            <div class="jumbotron text-center">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-0">
                    <a class="navbar-brand" href="#"><img src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download" width="40" height="40" alt="kk8 logo"></a>
                    
                    <!-- This button appear at the navbar when the user make the browser smaller -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

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
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $profilepicPath ?>" width="30" height="30" class="rounded-circle" alt="default-pic"></a>
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
                <h1 class="display-4">Activity Registration</h1>
                <p>Create lifelong memories and gain experiences through these activities.</p>
                
            </div>
        </header>
        <main>
            <div class="container">
                <div class="w3-content">

                <?php
                if (isset($_SESSION['activityName'])&&isset($_SESSION['projectName'])) {
                    $activitySes = $_SESSION['activityName'];
                    $projectSes = $_SESSION['projectName'];
                    echo "<script type='text/javascript'>
                    $(document).ready(function(){
                    $('#registerModal').modal('show');
                    });
                    </script>"; ?>    

                    <!-- Register Modal -->
                    <div class="modal fade" id="registerModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Success registration</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                            </div>
                            <div class="modal-body">
                                Thank you for registering <?php echo $activitySes; ?> by <?php echo $projectSes; ?>!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                <?php
                    unset($_SESSION['activityName']);
                    unset($_SESSION['projectName']);
                }
                ?> 
                    <p class="alert alert-info text-center m-auto p-auto center-block" style="width: 500px;">Click on the activity name to view their details.</p><br>
                    <div id="myTab" class="w3-row w3-center w3-border  bg-light-grey"  style="border: 0.95px solid #7289da !important; border-radius: 20px;">
                        <a href="javascript:void(0)" onclick="openMenu(event, 'JTK');">
                            <div class="active w3-col s2 tablink w3-padding w3-hover-codecolour" style="border-radius: 20px;" id="myLink">JTK
                            </div>
                        </a>
                        <a href="javascript:void(0)" onclick="openMenu(event, 'ADIN');">
                            <div class="w3-col s2 tablink w3-padding w3-hover-codecolour" style="border-radius: 20px;" >ADIN</div>
                        </a>
                        <a href="javascript:void(0)" onclick="openMenu(event, 'KEMAS');">
                            <div class="w3-col s2 tablink w3-padding w3-hover-codecolour" style="border-radius: 20px;">KEMAS</div>
                        </a>
                        <a href="javascript:void(0)" onclick="openMenu(event, 'KEP');">
                            <div class="w3-col s2 tablink w3-padding w3-hover-codecolour" style="border-radius: 20px;">KEP</div>
                        </a>
                        <a href="javascript:void(0)" onclick="openMenu(event, 'SENI');">
                            <div class="w3-col s2 tablink w3-padding w3-hover-codecolour" style="border-radius: 20px;">SENI</div>
                        </a>
                        <a href="javascript:void(0)" onclick="openMenu(event, 'SUKAN');">
                            <div class="w3-col s2 tablink w3-padding w3-hover-codecolour" style="border-radius: 20px;">SUKAN</div>
                        </a>

                    </div>
                    
                    <div id="JTK" class="w3-container menu w3-padding-32 w3-white">
                        <?php
                        $sql = "SELECT * FROM collegeactivity WHERE jtk = 'JTK'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $jtkid = $row['jtkID'];
                                $jtk = $row['jtk'];
                                $projectName = $row['projectName'];
                                $activityName = $row['activityName'];
                                $detail = $row['detail'];
                                $orgDate = $row['activityDate'];
                                $activityDate = date("d-m-Y", strtotime($orgDate));
                                $close = $row['closeDate'];
                                $closeDate = date("d-m-Y", strtotime($close));
                                $matricNo = $_SESSION['user_id'];
                                    
                                if ($close < $today) {
                                    $restrict = "style=\"background-color: white; color: grey; text-decoration: none; display: inline-block; padding: 5px; border: 1px solid #eee; border-radius: 0.3rem;\"disabled";
                                    $closeButton = "Closed";
                                    $closeInput = "Closed";
                                } else {
                                    $restrict = "";
                                    $closeButton = "Unregister";
                                    $closeInput = "Register";
                                }

                                $sql_1 = "SELECT * FROM activity WHERE `matricNo` = '$matricNo' AND `projectName` = '$projectName' AND `projectActivity` = '$activityName'";
                                $result_1 = $conn->query($sql_1) or die($conn->error);
                                if ($result_1->num_rows > 0) {
                                    // check if user has already registered the activity
                                    while ($row_1 = $result_1->fetch_assoc()) {
                                        $id=$row_1['projectID'];
                                        if ($jtk == 'JTK') {?>
                                                <button class="unregister w3-right" data-toggle='modal' data-target='#unregisterModalJTK_<?php echo $id;?>' <?php echo $restrict;?>><?php echo $closeButton;?></button>
                                                <a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid;?>'><label for="<?php echo $activityName;?>"><?php echo $activityName;?></label></a>
                                                <p class="w3-text-grey">&emsp;by <?php echo $projectName;?></p>
                                                <div class="modal fade" id="unregisterModalJTK_<?php echo $id;?>" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Cancel registration</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                                            </div>
                                                            <form action="activityProcess.php" method="POST">
                                                                <div class="modal-body">
                                                                    Are you sure to cancel your registration?<br><br>
                                                                    '<?php echo $activityName;?>' by '<?php echo $projectName;?>'
                                                                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                                                                    <input type="hidden" name="activity" value="<?php echo $activityName;?>" />
                                                                    <input type="hidden" name="project" value="<?php echo $projectName;?>" />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <input type="submit" name="unregister" class="btn btn-danger " value="Yes, I'm sure"/>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php
                                            }
                                    }
                                } else {
                                    if ($jtk == 'JTK') {
                                        ?>
                                                <form action="activityProcess.php" method="POST">
                                                    <input type="hidden" name="activity" value="<?php echo $activityName; ?>" />
                                                    <input type="hidden" name="project" value="<?php echo $projectName; ?>" />
                                                    <a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid; ?>'><label for="<?php echo $activityName; ?>"><?php echo $activityName; ?></label></a>
                                                    <!-- <label for="<?php echo $activityName; ?>"><?php echo $activityName; ?></label> -->
                                                    <input type="submit" name="submit" class="button w3-right" value=<?php echo $closeInput?> <?php echo $restrict; ?>/>
                                                    <p class="w3-text-grey">&emsp;by <?php echo $projectName; ?></p>
                                                </form>
                                                <hr>
                                            <?php
                                    }
                                } ?>
                                    <div class="modal fade" id="detailModal_<?php echo $jtkid; ?>" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Activity details</h5>
                                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button> -->
                                                </div>
                                                <div class="modal-body">
                                                    <table>
                                                        <tr>
                                                            <th style="width:130px"></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        <tr>
                                                            <td style="vertical-align: top; text-align: left;">Details</td>
                                                            <td style="vertical-align: top; text-align: left;">:</td>
                                                            <td>&nbsp;<?php echo $detail; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Activity Date</td>
                                                            <td>:</td>
                                                            <td>&nbsp;<?php echo $activityDate; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Last Registration</td>
                                                            <td>:</td>
                                                            <td>&nbsp;<?php echo $closeDate; ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <div id="ADIN" class="w3-container menu w3-padding-32 w3-white">
                    <?php
                        $sql = "SELECT * FROM collegeactivity WHERE jtk = 'ADIN'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $jtkid = $row['jtkID'];
                                $jtk = $row['jtk'];
                                $projectName = $row['projectName'];
                                $activityName = $row['activityName'];
                                $detail = $row['detail'];
                                $orgDate = $row['activityDate'];
                                $activityDate = date("d-m-Y", strtotime($orgDate));
                                $close = $row['closeDate'];
                                $closeDate = date("d-m-Y", strtotime($close));
                                $matricNo = $_SESSION['user_id'];
                                
                                if ($close < $today) {
                                    $restrict = "style=\"background-color: white; color: grey; text-decoration: none; display: inline-block; padding: 5px; border: 1px solid #eee; border-radius: 0.3rem;\"disabled";
                                    $closeButton = "Closed";
                                    $closeInput = "Closed";
                                } else {
                                    $restrict = "";
                                    $closeButton = "Unregister";
                                    $closeInput = "Register";
                                }

                                $sql_1 = "SELECT * FROM activity WHERE `matricNo` = '$matricNo' AND `projectName` = '$projectName' AND `projectActivity` = '$activityName'";
                                $result_1 = $conn->query($sql_1);

                                // if student already registered
                                if ($result_1->num_rows > 0) {
                                    while ($row_1 = $result_1->fetch_assoc()) {
                                        $id=$row_1['projectID'];
                                        if ($jtk == 'ADIN') {?>
                                            <button class="unregister w3-right" data-toggle='modal' data-target='#unregisterModalADIN_<?php echo $id;?>' <?php echo $restrict;?>><?php echo $closeButton;?></button>
                                            <a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid;?>'><label for="<?php echo $activityName;?>"><?php echo $activityName;?></label></a>
                                            <p class="w3-text-grey">&emsp;by <?php echo $projectName;?></p>
                                            <div class="modal fade" id="unregisterModalADIN_<?php echo $id;?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cancel registration</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <form action="activityProcess.php" method="POST">
                                                        <div class="modal-body">
                                                            Are you sure to cancel your registration?<br><br>
                                                            '<?php echo $activityName;?>' by '<?php echo $projectName;?>'
                                                            <input type="hidden" name="id" value="<?php echo $id;?>" />
                                                            <input type="hidden" name="activity" value="<?php echo $activityName;?>" />
                                                            <input type="hidden" name="project" value="<?php echo $projectName;?>" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <input type="submit" name="unregister" class="btn btn-danger " value="Yes, I'm sure"/>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php
                                        }
                                    }
                                } else {
                                    if ($jtk == 'ADIN') {
                                        ?>
                                            <form action="activityProcess.php" method="POST">
                                                <input type="hidden" name="activity" value="<?php echo $activityName; ?>" />
                                                <input type="hidden" name="project" value="<?php echo $projectName; ?>" />
                                            	<a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid; ?>'><label for="<?php echo $activityName; ?>"><?php echo $activityName; ?></label></a>
                                                <input type="submit" name="submit" class="button w3-right" value=<?php echo $closeInput?> <?php echo $restrict; ?>/>
                                                <p class="w3-text-grey">&emsp;by <?php echo $projectName; ?></p>
                                            </form>
                                            <hr>
                                        <?php
                                    }
                                } ?>
                                <div class="modal fade" id="detailModal_<?php echo $jtkid; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Activity details</h5>
                                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button> -->
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <th style="width:130px"></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top; text-align: left;">Details</td>
                                                        <td style="vertical-align: top; text-align: left;">:</td>
                                                        <td>&nbsp;<?php echo $detail; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Activity Date</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $activityDate; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Registration</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $closeDate; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <div id="KEMAS" class="w3-container menu w3-padding-32 w3-white">
                    <?php
                        $sql = "SELECT * FROM collegeactivity WHERE jtk = 'KEMAS'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $jtkid = $row['jtkID'];
                                $jtk = $row['jtk'];
                                $projectName = $row['projectName'];
                                $activityName = $row['activityName'];
                                $detail = $row['detail'];
                                $orgDate = $row['activityDate'];
                                $activityDate = date("d-m-Y", strtotime($orgDate));
                                $close = $row['closeDate'];
                                $closeDate = date("d-m-Y", strtotime($close));
                                $matricNo = $_SESSION['user_id'];
                                
                                if ($close < $today) {
                                    $restrict = "style=\"background-color: white; color: grey; text-decoration: none; display: inline-block; padding: 5px; border: 1px solid #eee; border-radius: 0.3rem;\"disabled";
                                    $closeButton = "Closed";
                                    $closeInput = "Closed";
                                } else {
                                    $restrict = "";
                                    $closeButton = "Unregister";
                                    $closeInput = "Register";
                                }

                                $sql_1 = "SELECT * FROM activity WHERE `matricNo` = '$matricNo' AND `projectName` = '$projectName' AND `projectActivity` = '$activityName'";
                                $result_1 = $conn->query($sql_1);

                                // if student already registered
                                if ($result_1->num_rows > 0) {
                                    while ($row_1 = $result_1->fetch_assoc()) {
                                        $id=$row_1['projectID'];
                                        if ($jtk == 'KEMAS') {?>
                                            <button class="unregister w3-right" data-toggle='modal' data-target='#unregisterModalKEMAS_<?php echo $id;?>' <?php echo $restrict;?>><?php echo $closeButton;?></button>
                                            <a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid;?>'><label for="<?php echo $activityName;?>"><?php echo $activityName;?></label></a>
                                            <p class="w3-text-grey">&emsp;by <?php echo $projectName;?></p>
                                            <div class="modal fade" id="unregisterModalKEMAS_<?php echo $id;?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cancel registration</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <form action="activityProcess.php" method="POST">
                                                        <div class="modal-body">
                                                            Are you sure to cancel your registration?<br><br>
                                                            '<?php echo $activityName;?>' by '<?php echo $projectName;?>'
                                                            <input type="hidden" name="id" value="<?php echo $id;?>" />
                                                            <input type="hidden" name="activity" value="<?php echo $activityName;?>" />
                                                            <input type="hidden" name="project" value="<?php echo $projectName;?>" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <input type="submit" name="unregister" class="btn btn-danger " value="Yes, I'm sure"/>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php
                                        }
                                    }
                                } else {
                                    if ($jtk == 'KEMAS') {
                                        ?>
                                            <form action="activityProcess.php" method="POST">
                                                <input type="hidden" name="activity" value="<?php echo $activityName; ?>" />
                                                <input type="hidden" name="project" value="<?php echo $projectName; ?>" />
                                            	<a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid; ?>'><label for="<?php echo $activityName; ?>"><?php echo $activityName; ?></label></a>
                                                <input type="submit" name="submit" class="button w3-right" value=<?php echo $closeInput?> <?php echo $restrict; ?>/>
                                                <p class="w3-text-grey">&emsp;by <?php echo $projectName; ?></p>
                                            </form>
                                            <hr>
                                        <?php
                                    }
                                } ?>
                                <div class="modal fade" id="detailModal_<?php echo $jtkid; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Activity details</h5>
                                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button> -->
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <th style="width:130px"></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top; text-align: left;">Details</td>
                                                        <td style="vertical-align: top; text-align: left;">:</td>
                                                        <td>&nbsp;<?php echo $detail; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Activity Date</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $activityDate; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Registration</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $closeDate; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <div id="KEP" class="w3-container menu w3-padding-32 w3-white">
                        <?php
                        $sql = "SELECT * FROM collegeactivity WHERE jtk = 'KEP'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $jtkid = $row['jtkID'];
                                $jtk = $row['jtk'];
                                $projectName = $row['projectName'];
                                $activityName = $row['activityName'];
                                $detail = $row['detail'];
                                $orgDate = $row['activityDate'];
                                $activityDate = date("d-m-Y", strtotime($orgDate));
                                $close = $row['closeDate'];
                                $closeDate = date("d-m-Y", strtotime($close));
                                $matricNo = $_SESSION['user_id'];
                                
                                if ($close < $today) {
                                    $restrict = "style=\"background-color: white; color: grey; text-decoration: none; display: inline-block; padding: 5px; border: 1px solid #eee; border-radius: 0.3rem;\"disabled";
                                    $closeButton = "Closed";
                                    $closeInput = "Closed";
                                } else {
                                    $restrict = "";
                                    $closeButton = "Unregister";
                                    $closeInput = "Register";
                                }

                                $sql_1 = "SELECT * FROM activity WHERE `matricNo` = '$matricNo' AND `projectName` = '$projectName' AND `projectActivity` = '$activityName'";
                                $result_1 = $conn->query($sql_1);

                                // if student already registered
                                if ($result_1->num_rows > 0) {
                                    while ($row_1 = $result_1->fetch_assoc()) {
                                        $id=$row_1['projectID'];
                                        if ($jtk == 'KEP') {?>
                                            <button class="unregister w3-right" data-toggle='modal' data-target='#unregisterModalKEP_<?php echo $id;?>' <?php echo $restrict;?>><?php echo $closeButton;?></button>
                                            <a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid;?>'><label for="<?php echo $activityName;?>"><?php echo $activityName;?></label></a>
                                            <p class="w3-text-grey">&emsp;by <?php echo $projectName;?></p>
                                            <div class="modal fade" id="unregisterModalKEP_<?php echo $id;?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cancel registration</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <form action="activityProcess.php" method="POST">
                                                        <div class="modal-body">
                                                            Are you sure to cancel your registration?<br><br>
                                                            '<?php echo $activityName;?>' by '<?php echo $projectName;?>'
                                                            <input type="hidden" name="id" value="<?php echo $id;?>" />
                                                            <input type="hidden" name="activity" value="<?php echo $activityName;?>" />
                                                            <input type="hidden" name="project" value="<?php echo $projectName;?>" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <input type="submit" name="unregister" class="btn btn-danger " value="Yes, I'm sure"/>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php
                                        }
                                    }
                                } else {
                                    if ($jtk == 'KEP') {
                                        ?>
                                            <form action="activityProcess.php" method="POST">
                                                <input type="hidden" name="activity" value="<?php echo $activityName; ?>" />
                                                <input type="hidden" name="project" value="<?php echo $projectName; ?>" />
                                            	<a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid; ?>'><label for="<?php echo $activityName; ?>"><?php echo $activityName; ?></label></a>
                                                <input type="submit" name="submit" class="button w3-right" value=<?php echo $closeInput?> <?php echo $restrict; ?>/>
                                                <p class="w3-text-grey">&emsp;by <?php echo $projectName; ?></p>
                                            </form>
                                            <hr>
                                        <?php
                                    }
                                } ?>
                                <div class="modal fade" id="detailModal_<?php echo $jtkid; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Activity details</h5>
                                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button> -->
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <th style="width:130px"></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top; text-align: left;">Details</td>
                                                        <td style="vertical-align: top; text-align: left;">:</td>
                                                        <td>&nbsp;<?php echo $detail; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Activity Date</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $activityDate; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Registration</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $closeDate; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <div id="SENI" class="w3-container menu w3-padding-32 w3-white">
                        <?php
                        $sql = "SELECT * FROM collegeactivity WHERE jtk = 'SENI'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $jtkid = $row['jtkID'];
                                $jtk = $row['jtk'];
                                $projectName = $row['projectName'];
                                $activityName = $row['activityName'];
                                $detail = $row['detail'];
                                $orgDate = $row['activityDate'];
                                $activityDate = date("d-m-Y", strtotime($orgDate));
                                $close = $row['closeDate'];
                                $closeDate = date("d-m-Y", strtotime($close));
                                $matricNo = $_SESSION['user_id'];
                                
                                if ($close < $today) {
                                    $restrict = "style=\"background-color: white; color: grey; text-decoration: none; display: inline-block; padding: 5px; border: 1px solid #eee; border-radius: 0.3rem;\"disabled";
                                    $closeButton = "Closed";
                                    $closeInput = "Closed";
                                } else {
                                    $restrict = "";
                                    $closeButton = "Unregister";
                                    $closeInput = "Register";
                                }

                                $sql_1 = "SELECT * FROM activity WHERE `matricNo` = '$matricNo' AND `projectName` = '$projectName' AND `projectActivity` = '$activityName'";
                                $result_1 = $conn->query($sql_1);

                                // if student already registered
                                if ($result_1->num_rows > 0) {
                                    while ($row_1 = $result_1->fetch_assoc()) {
                                        $id=$row_1['projectID'];
                                        if ($jtk == 'SENI') {?>
                                            <button class="unregister w3-right" data-toggle='modal' data-target='#unregisterModalSENI_<?php echo $id;?>' <?php echo $restrict;?>><?php echo $closeButton;?></button>
                                            <a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid;?>'><label for="<?php echo $activityName;?>"><?php echo $activityName;?></label></a>
                                            <p class="w3-text-grey">&emsp;by <?php echo $projectName;?></p>
                                            <div class="modal fade" id="unregisterModalSENI_<?php echo $id;?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cancel registration</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <form action="activityProcess.php" method="POST">
                                                        <div class="modal-body">
                                                            Are you sure to cancel your registration?<br><br>
                                                            '<?php echo $activityName;?>' by '<?php echo $projectName;?>'
                                                            <input type="hidden" name="id" value="<?php echo $id;?>" />
                                                            <input type="hidden" name="activity" value="<?php echo $activityName;?>" />
                                                            <input type="hidden" name="project" value="<?php echo $projectName;?>" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <input type="submit" name="unregister" class="btn btn-danger " value="Yes, I'm sure"/>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php
                                        }
                                    }
                                } else {
                                    if ($jtk == 'SENI') {
                                        ?>
                                            <form action="activityProcess.php" method="POST">
                                                <input type="hidden" name="activity" value="<?php echo $activityName; ?>" />
                                                <input type="hidden" name="project" value="<?php echo $projectName; ?>" />
                                            	<a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid; ?>'><label for="<?php echo $activityName; ?>"><?php echo $activityName; ?></label></a>
                                                <input type="submit" name="submit" class="button w3-right" value=<?php echo $closeInput?> <?php echo $restrict; ?>/>
                                                <p class="w3-text-grey">&emsp;by <?php echo $projectName; ?></p>
                                            </form>
                                            <hr>
                                        <?php
                                    }
                                } ?>
                                <div class="modal fade" id="detailModal_<?php echo $jtkid; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Activity details</h5>
                                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button> -->
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <th style="width:130px"></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top; text-align: left;">Details</td>
                                                        <td style="vertical-align: top; text-align: left;">:</td>
                                                        <td>&nbsp;<?php echo $detail; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Activity Date</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $activityDate; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Registration</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $closeDate; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <div id="SUKAN" class="w3-container menu w3-padding-32 w3-white">
                        <?php
                        $sql = "SELECT * FROM collegeactivity WHERE jtk = 'SUKAN'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $jtkid = $row['jtkID'];
                                $jtk = $row['jtk'];
                                $projectName = $row['projectName'];
                                $activityName = $row['activityName'];
                                $detail = $row['detail'];
                                $orgDate = $row['activityDate'];
                                $activityDate = date("d-m-Y", strtotime($orgDate));
                                $close = $row['closeDate'];
                                $closeDate = date("d-m-Y", strtotime($close));
                                $matricNo = $_SESSION['user_id'];
                                
                                if ($close < $today) {
                                    $restrict = "style=\"background-color: white; color: grey; text-decoration: none; display: inline-block; padding: 5px; border: 1px solid #eee; border-radius: 0.3rem;\"disabled";
                                    $closeButton = "Closed";
                                    $closeInput = "Closed";
                                } else {
                                    $restrict = "";
                                    $closeButton = "Unregister";
                                    $closeInput = "Register";
                                }

                                $sql_1 = "SELECT * FROM activity WHERE `matricNo` = '$matricNo' AND `projectName` = '$projectName' AND `projectActivity` = '$activityName'";
                                $result_1 = $conn->query($sql_1);
                                if ($result_1->num_rows > 0) {
                                    while ($row_1 = $result_1->fetch_assoc()) {
                                        $id=$row_1['projectID'];
                                        if ($jtk == 'SUKAN') {?>
                                            <button class="unregister w3-right" data-toggle='modal' data-target='#unregisterModalSUKAN_<?php echo $id;?>' <?php echo $restrict;?>><?php echo $closeButton;?></button>
                                            <a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid;?>'><label for="<?php echo $activityName;?>"><?php echo $activityName;?></label></a>
                                            <p class="w3-text-grey">&emsp;by <?php echo $projectName;?></p>
                                            <div class="modal fade" id="unregisterModalSUKAN_<?php echo $id;?>" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cancel registration</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                                    </div>
                                                    <form action="activityProcess.php" method="POST">
                                                        <div class="modal-body">
                                                            Are you sure to cancel your registration?<br><br>
                                                            '<?php echo $activityName;?>' by '<?php echo $projectName;?>'
                                                            <input type="hidden" name="id" value="<?php echo $id;?>" />
                                                            <input type="hidden" name="activity" value="<?php echo $activityName;?>" />
                                                            <input type="hidden" name="project" value="<?php echo $projectName;?>" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <input type="submit" name="unregister" class="btn btn-danger " value="Yes, I'm sure"/>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php
                                        }
                                    }
                                } else {
                                    if ($jtk == 'SUKAN') {
                                        ?>
                                            <form action="activityProcess.php" method="POST">
                                                <input type="hidden" name="activity" value="<?php echo $activityName; ?>" />
                                                <input type="hidden" name="project" value="<?php echo $projectName; ?>" />
                                            	<a data-toggle='modal' data-target='#detailModal_<?php echo $jtkid; ?>'><label for="<?php echo $activityName; ?>"><?php echo $activityName; ?></label></a>
                                                <input type="submit" name="submit" class="button w3-right" value=<?php echo $closeInput?> <?php echo $restrict; ?>/>
                                                <p class="w3-text-grey">&emsp;by <?php echo $projectName; ?></p>
                                            </form>
                                            <hr>
                                        <?php
                                    }
                                } ?>
                                <div class="modal fade" id="detailModal_<?php echo $jtkid; ?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Activity details</h5>
                                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button> -->
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <th style="width:130px"></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top; text-align: left;">Details</td>
                                                        <td style="vertical-align: top; text-align: left;">:</td>
                                                        <td>&nbsp;<?php echo $detail; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Activity Date</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $activityDate; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Registration</td>
                                                        <td>:</td>
                                                        <td>&nbsp;<?php echo $closeDate; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="buttons btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
                <!-- end w3-content -->
            </div>
            <!-- end of container -->
        </main>
        <br>
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
            function openMenu(evt, menuName) {
                var i, x, tablinks;
                x = document.getElementsByClassName("menu");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < x.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" codecolour", "");
                }
                document.getElementById(menuName).style.display = "block";
                evt.currentTarget.firstElementChild.className += " codecolour";
                // window.history.replaceState(null, null, "activityReg.php");
            }
            document.getElementById("myLink").click();
        </script>
    </body>
</html>