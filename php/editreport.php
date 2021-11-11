<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
  session_destroy();
  header('location: nologin.php');
}
//echo $_SESSION['user_id'];
include_once('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ticketNo = $_POST['ticketNo'];
  //echo 'ticketNo: ' . $ticketNo;
  $sql = 'SELECT * FROM report WHERE ticketNo="' . $ticketNo . '"';
  $result = $conn->query($sql) or die($conn->error);
  $row = $result->fetch_assoc();
  $problemType = $row['problemType'];
  $problemDetails = $row['problemDetails'];
  $mobileNum = $row['mobileNum'];
  $problemLocation = $row['problemLocation'];
}

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
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>KK8 - Edit Report</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Override Bootstrap CSS with custom CSS file -->
  <link rel="stylesheet" type="text/css" href="../css/report.css">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
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
        <a class="navbar-brand" href="#"><img src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download" width="40" height="40" alt="kk8 logo"></a>
        <!-- This button appear at the navbar when the user make the browser smaller -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
              <a class="nav-link" href="accoApply.php">Room</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="report.php">Report</a>
            </li>
          </ul>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="<?php echo $profilepicPath?>" width="30" height="30" class="rounded-circle" alt="default-pic">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="manage.php">Manage Profile</a>
                  <a class="dropdown-item" href="home.php">Log Out</a>
                </div>
              </div>
            </li>
          </ul>
        </div>

      </nav>
      <br><br>
      <h1 class="display-4">Edit A Report</h1>
    </div>
  </header>
  <main class="px-5 container jumbotron">
    <form id="form" method="post" action="updatereport.php" enctype="multipart/form-data">
      <div class=" form-group row">
      <input type="text" name="ticketNo" value="<?= $ticketNo ?>" hidden>
      <div class="col-md-2"></div>
      <div class="col-md-10 my-2">
        <h3 style="font-weight:bold;">Report Ticket No. : <?= $ticketNo ?></h3>
      </div>
      <label for="inputEmail3" class="col-md-2 col-form-label mt-2 text-md-right">Problem
        Type</label>
      <div class="col-md-10 mb-0 pt-3">
        <?= $problemType ?>
      </div>
      <label for="exampleFormControlTextarea1" class="col-md-2 col-form-label mt-2 text-md-right">Problem
        Details</label>
      <div class="col-md-10 my-2">
        <textarea class="form-control" id="exampleFormControlTextarea1" name="details" rows="3" placeholder="Please describe your problem" required><?= $problemDetails ?></textarea>
      </div>
      <label for="exampleInputPassword1" class="col-md-2 col-form-label mt-2 text-md-right">Mobile
        Phone Num.</label>
      <div class="col-md-10 my-2">
        <input type="text" class="form-control mx-0" name="phoneNumber" id="tel" placeholder="Enter mobile phone number" value="<?= $mobileNum ?>" required="" style="width:100%;">
      </div>
      <label for="exampleInputPassword1" class="col-md-2 col-form-label mt-2 text-md-right">Problem
        Location</label>
      <div class="col-md-10 my-2">
        <textarea name="location" rows="3" class="form-control" id="hd_location" placeholder="Please describe your problem location" required=""><?= $problemLocation ?></textarea>
      </div>
      <label for="exampleInputFile" class="col-md-2 col-form-label mt-2 text-md-right">Upload
        File </label>
      <div class="col-md-10 my-2">
        <input name="uploadedfile" type="file" id="uploadedfile">
        <p class="help-block">Note: only jpg , gif , png ,pdf , doc , docx and max size
          5 MB.</p>
      </div>
      <div class="col-md-2">
      </div>
      <div class="col-lg-3 my-1 inline-block">
        <button type="submit" id="updateReport" name="update" value="update" class="btn btn-primary">Update</button>
        <a type="danger" class="btn btn-danger btn-sm m-1" style="color:white;" href="report.php">Cancel</a>
      </div>

      </div>
    </form>

  </main>

  <!--  container-fluid px-2 px-sm-5 py-auto bg-dark  -->
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