<!DOCTYPE html>
<html>
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

if ($result->num_rows > 0) {
    while ($res = $result->fetch_assoc()) {
        $userid = $res["matricNo"];
        $name = $res["fullname"];
        $email = $res["email"];
        $icNum = $res["icNum"];
        $gender = $res["gender"];
        $race = $res["race"];
        $birthdate = $res["birthdate"];
        $address = $res["address"];
        $levelStudy = $res["levelStudy"];
        $faculty = $res["faculty"];
        $programme = $res["programme"];
        $semester = $res["semester"];
        $disability = $res["disability"];
        $disabilityStatus = $res["disabilityStatus"];
        $roomNo = $res["roomNo"];
        $profilepicPath = $res["profilepicPath"];
    }
}

?>

<head>
    <meta charset="utf-8">
    <!-- To make the site responsive when user resize the browser -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="bootstrap-4.4.1-dist\css\bootstrap.css"> -->
    <!-- Bootstrap CSS source file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/login.css">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../css/manage.css">
    <!-- Custom css to override any class in bootstrap.css -->

    <style>
        .emp-profile {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fdfdfd;
            text-align: left-align;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }

        .profile-img {
            text-align: center;

        }

        .profile-img img {
            width: 150px;
            height: 150px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
            object-fit: cover;

        }

        .profile-head h5 {
            color: #333;
        }

        .profile-head h6 {
            color: #0062cc;
        }

        .profile-edit-btn {
            border: none;
            border-radius: 1.5rem;
            width: 100%;
            padding: 5%;
            font-weight: 600;
            background-color: #7289da !important;
            color: white !important;
            cursor: pointer;
        }

        .profile-edit-btn-inside {
            border: none;
            border-radius: 1.5rem;
            font-size: 15px;
            width: 50%;
            padding: 5px;
            font-weight: 600;
            background-color: #7289da !important;
            color: white !important;
            cursor: pointer;
        }


        .profile-head .nav-tabs {
            margin-bottom: 5%;
        }

        .profile-head .nav-tabs .nav-link {
            font-weight: 600;
            border: none;
        }

        .profile-head .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 2px solid #0062cc;
        }

        .profile-work {
            padding: 14%;
            margin-top: -11%;
        }

        .profile-work p {
            font-size: 15px;
            color: #818182;
            font-weight: 600;
            margin-top: 1%;
        }

        .profile-work h4 {
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 15px;
        }

        .profile-work ul {
            list-style: none;
        }


        .profile-tab label {
            font-weight: 600;
        }

        .profile-tab p {
            font-weight: 600;
            color: #0062cc;
        }

        input[type=text],
        input[type=password],
        input[type=email] {
            padding-left: 15px;
        }
    </style>

    <title>Manage Account</title>

</head>

<body>
    <header>
        <div class="jumbotron text-center">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-0">
                <a class="navbar-brand" href="#"><img src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download" width="40" height="40" alt="kk8 logo"></a>
                <!-- This button appear at the navbar when the user make the browser smaller -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!--  This navbar dissapear when the user make the browser smaller -->
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
                            <a class="nav-link" href="accoApply.php">Accomodation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="report.php">Report</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?php echo $profilepicPath ?>" width="30" height="30" class="rounded-circle" style="object-fit:cover;" alt="no-pic">
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
            <h1 class="display-4">Manage account</h1>
            <p class="lead">You can manage your account here and make sure your personal information is the latest.
            </p>
        </div>
    </header>
    <!-- New profile form -->
    <div class="container emp-profile">
        <form method="">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="<?php echo $profilepicPath ?>" alt="" />

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            <?php echo $name ?>
                        </h5>
                        <h6>
                            <?php echo $levelStudy ?>
                        </h6>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Academic</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="acoount-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">Account</a>
                            </li>

                        </ul>
                    </div>
                </div>


                <div class="col-md-2">
                    <button type="button" onclick="update_details()" class="profile-edit-btn">Edit Details</button>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>ROOM</p>
                        <h4><?php echo $roomNo ?></h4><br>
                        <p>DISABILITY</p>
                        <h4 href=""><?php echo $disabilityStatus ?></h4><br>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Username</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><?php echo $userid; ?></p>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><?php echo $name ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><?php echo $email ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>I/C Number</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><?php echo $icNum ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Gender</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><?php echo $gender ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Address</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><?php echo $address ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Faculty</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><?php echo $faculty ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Programme</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><?php echo $programme ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Semester</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><?php echo $semester ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                            <!-- <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Change password</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <button type="button" onclick="change_password()" data-toggle="modal" data-target="changepasswordModal" class="profile-edit-btn-inside">Change password</button>
                                </div>
                            </div> -->
                            <!-- <div class="row">
                                <br>
                            </div> -->
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <label>Delete Account</label>
                                </div>
                                <div class="col-md-6 text-left">
                                    <button type="button" onclick="delete_account()" data-toggle="modal" data-target="deleteaccountModal" class="profile-edit-btn-inside" style="background-color: #ff3f3f !important;">Delete your account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="changepasswordModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header d-flex flex-column">
                    <button type="button" class="close p-0" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title text-left mx-auto">Change password</h3>
                </div>
                <div class="modal-body">
                    <form id="changepasswordForm" action="change_password.php" method="POST">
                        <div class="form-group text-left">
                            <label for="password">Current password</label>
                            <input type="password" name="password" class="form-control" placeholder="Current password" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="password">Verify current password</label>
                            <input type="password" name="vpassword" class="form-control" placeholder="Verify current password" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="password">New password</label>
                            <input type="password" name="newpassword" class="form-control" placeholder="New password" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="password">Verify new password</label>
                            <input type="password" name="vnewpassword" class="form-control" placeholder="Verify new password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg full" id="newPassword">Change password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteaccountModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex flex-column">
                    <button type="button" class="close p-0" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title text-left mx-auto">Delete your account</h3>
                    <br>
                    <h6 class="text-center mx-auto">Deleting your account will permanently remove your profile, personal informations and all other associated informations. Once your account is deleted,
                        you will be logged out and will be unable to log back in.
                    </h6>

                </div>
                <div class="modal-body">
                    <form action="delete_account.php" method="POST">
                        <div class="form-group text-left">
                            <label for="password">Current password</label>
                            <input type="password" name="deletePassword" id="deletePassword" class="form-control" placeholder="Current password" required>
                        </div>
                        <div class="form-group text-left">
                            <label for="password">Verify current password</label>
                            <input type="password" name="vdeletePassword" id="vdeletePassword" class="form-control" placeholder="Verify current password" required>
                            <span id='namemessage'></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg full" name="submit" id="deleteaccountButton">Yes, I agree</button>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-primary btn-lg full mb-4" style="background-color:#bababa !important" data-dismiss="modal">Cancel</button>

                </div>
                
            </div>
        </div>
        
    </div>



    <script>
        function update_details() {
            location.href = "update_details.php";
        }

        function change_password() {
            $('#changepasswordModal').modal('show');
        }

        function delete_account() {
            $('#deleteaccountModal').modal('show');
        }
    </script>
    <br>
    <!-- Bootstrap JS source file link -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
            //checking password and verify password is same or not (delete account modal)
            var passwordokay = false;
            $('#deletePassword, #vdeletePassword').on('keyup', function() {
                if ($('#vdeletePassword').val() != "") {
                    if ($('#deletePassword').val() == $('#vdeletePassword').val()) {
                        $('#namemessage').html('Matching').css('color', 'green');
                        passwordokay = true;
                        updateAllowed();
                    } else {
                        $('#namemessage').html('Not Matching').css('color', 'red');
                        passwordokay = false;
                        updateAllowed();
                    }
                } else if ($('#deletePassword').val() == "" || $('#vdeletePassword').val() == "") {
                    $('#namemessage').html('');
                }
            });

            function updateAllowed() {
                if (passwordokay) {
                    document.getElementById("deleteaccountButton").disabled = false;
                } else {
                    document.getElementById("deleteaccountButton").disabled = true;
                }
            };
        </script>

    <script>
        $(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
        })
    </script>

    <!-- Footer of the site -->
    <footer class="container-fluid px-2 px-sm-5 py-auto">
        <div class="d-flex flex-column flex-sm-row text-light font-italic">
            <div class="py-1 ml-sm-0 text-center">
                Copyright © 2020 - Kinabalu Residential College,&nbsp;<a class="text-light text-nowrap ml-sm-0" data-toggle="tooltip" data-placement="top" href="https://www.um.edu.my/" title="um.edu.my"><u>
                        University
                        of Malaya</u>
                </a>.
            </div>
            <div class="mx-auto mr-sm-0 pt-sm-1 pb-2 pb-sm-0">
                <a tabindex="0" class="text-light" data-toggle="tooltip" data-placement="top" href="https://www.instagram.com/unimalaya/" title="@unimalaya"><i class="px-2 fa fa-instagram fa-lg"></i></a><a tabindex="0" class="text-light" data-toggle="tooltip" data-placement="top" href="https://twitter.com/unimalaya/" title="@unimalaya"><i class="px-2 fa fa-twitter fa-lg"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>