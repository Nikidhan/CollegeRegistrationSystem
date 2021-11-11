<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}
//echo $_SESSION['user_id'];
$user_id= $_SESSION['user_id'];
include_once('config.php');
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
    <title>KK8 - Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Override Bootstrap CSS with custom CSS file -->
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <style>
    </style>
    <script>
        $(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        function smoothScroll(elementId) {
        var MIN_PIXELS_PER_STEP = 16;
        var MAX_SCROLL_STEPS = 30;
        var target = document.getElementById(elementId);
        var scrollContainer = target;
        do {
            scrollContainer = scrollContainer.parentNode;
            if (!scrollContainer) return;
            scrollContainer.scrollTop += 1;
        } while (scrollContainer.scrollTop == 0);

        var targetY = 0;
        do {
            if (target == scrollContainer) break;
            targetY += target.offsetTop;
        } while (target = target.offsetParent);

        var pixelsPerStep = Math.max(MIN_PIXELS_PER_STEP,
            (targetY - scrollContainer.scrollTop) / MAX_SCROLL_STEPS);

        var stepFunc = function() {
            scrollContainer.scrollTop =
            Math.min(targetY, pixelsPerStep + scrollContainer.scrollTop);

            if (scrollContainer.scrollTop >= targetY) {
            return;
            }

            window.requestAnimationFrame(stepFunc);
        };

        window.requestAnimationFrame(stepFunc);
        };
    </script>
</head>

<body>
<header>
    <div class="jumbotron text-center">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-0">
        <a class="navbar-brand" href="#">
        <img src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download" width="40" height="40" alt="kk8 logo">
        </a>
        <!-- This button appear at the navbar when the user make the browser smaller -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <!-- 	This navbar dissapear when the user make the browser smaller -->
        <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Items in the navbar can be included in the list -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
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
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo $profilepicPath ?>" width="30" height="30" class="rounded-circle" alt="default-pic">
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
    <h1 class="display-4">Dashboard</h1>
    <p class="lead">-----------------------------------</p>
    </div>
</header>
<main class="container-fluid">
    <div class="row px-5 mb-5">
    <div class="col-12 col-md-5 col-xl-3 pr-0 pl-0 pb-0 mb-3 mt-0 pt-0 mb-md-0" id="scrollableNotification" style="max-height: 816px;">
        <button class="notification-toggler d-md-none py-0" style="width: 100%;" type="button" data-toggle="collapse" data-target="#notifications" aria-controls="notifications" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars float-left mt-2" style="font-size: 34px;"></i>
        <div class="d-inline-flex">
            <h5>Notifications</h5>
        </div>
        </button>
        <div class="collapse navbar-collapse d-md-block sticky-top" id="notifications">
        <div class="card main-card">
            <div class="card-header d-none d-md-block" id="dashboard-card-headers">
            <h5>Notifications</h5>
            </div>
            <!-- Items in the navbar can be included in the list -->
            <div id="accordion">
            <div class="card">
                <div class="card-header py-0 pl-1" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    COLLEGE
                    </button>

                </h5>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <ul>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#exampleModal">PENGAMBILAN BARANG KOLEJ
                        KEDIAMAN
                        KINABALU</a>
                    </li>
                    </ul>

                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header py-0 pl-1" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    FESTIVAL BELIA ISLAM 2020
                    </button>

                </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    <ul>
                    <li><a href="#">POST-MORTEM PERKAMPUNGAN SEMESTER 1</a></li>
                    </ul>
                </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header py-0 pl-1" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    KINAWORKS CLUB
                    </button>

                </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    <ul>
                    <li><a href="#">SUKMUM CURATION SUBMISSION</a></li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-12 col-md-7 col-xl-9 px-0 mx-0 pl-md-3 pl-0" style="height:100%">
        <div class="card main-card" id="registered-project">
        <div class="card-header" id="dashboard-card-headers">
            <h5>Registered Activities</h5>
        </div>
        <div class="card-body d-flex flex-row p-2 my-3 px-auto scrollmenu">
            <?php

            $sql = 'SELECT * FROM activity WHERE matricNo="' . $_SESSION['user_id'] . '" ORDER BY projectName, projectActivity';
            $result = $conn->query($sql) or die($conn->error);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $projectName = $row['projectName'];
                    $projectActivity = $row['projectActivity']; ?>
                <div class="p-2 text-center rounded-circle">
                <div class="card px-2 py-3" style="width:175px;height:100%;white-space:normal;">
                    <div class="card-body p-0 m-0">
                    <div class="card-title">
                        <h5 style="color: #2f4596;font-weight:bold;"><?= $projectName; ?></h5>
                    </div>
                    <hr class="">
                    <div class="card-text">
                        <div><?= $projectActivity; ?></div>
                    </div>
                    </div>
                </div>
                </div><?php
                }
            }

                    ?>
        </div>
        </div>
        <div class="my-3">
        <div class="card main-card" id="announcements">
            <div class="card-header" id="dashboard-card-headers">
            <h5>News & Announcements</h5>
            </div>
            <div class="card-body">
            <?php include('slideshow.php');?>

            </div>
        </div>
        </div>
    </div>
    </div>
</main>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
            PENGAMBILAN BARANG KOLEJ KEDIAMAN KINABALU</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>
            Assalamualaikum dan Salam Sejahtera semua,
            <br><br>
            Kepada semua pelajar yang ingin mengambil barang di
            Kolej Kediaman Kinabalu diminta utk mengisi google
            form yang telah
            disediakan.
            <br><br>
            Hal ini bagi memudahkah pihak pengurusan kolej untuk
            menguruskan data daftar keluar pelajar dari kolej
            kediaman.
            <br><br>
            Sila isi butir-butir yang diperlukan di Google Form
            ini 👇🏻
            <br><br>
            <a href="http://shorturl.at/bdltV">http://shorturl.at/bdltV</a>
            <br><br>
            Alternatif
            <br><br>
            <a class="long-url" href="https://docs.google.com/forms/d/e/1FAIpQLSeIv10tnuDZG_RMTbI0kjWaw05tCT0CQmz_MFgJ5zP_CjYptQ/viewform">https://docs.google.com/forms/d/e/1FAIpQLSeIv10tnuDZG_RMTbI0kjWaw05tCT0CQmz_MFgJ5zP_CjYptQ/viewform</a>
            <br><br>
            Segala kerosakan yang berlaku ketika pengambilan
            barang anda adalah tanggungjawab anda sendiri
            <br><br>
            Khidmat stor tidak akan disediakan, sekiranya
            pelajar ingin menyimpan barangan di kolej kediaman.
            </p>
        </div>
        </div>
    </div>
</div>
</body>

</html>