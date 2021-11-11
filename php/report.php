<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}
//echo $_SESSION['user_id'];
include_once('config.php');
$currentMonth = date('m');

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
  <title>KK8 - Report</title>
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


    function deleterow(r) {
      var i = r.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.rowIndex;
      //var i = r + 1;
      var j = r.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
      console.log(i);
      document.getElementById("report-table").deleteRow(i);
    };

    function deletereport(ticketNum) {
      $.ajax({
        type: "POST",
        url: 'deleteReport.php',
        data: {
          ticketNo: ticketNum
        }

      });
    };

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

    window.setTimeout(function() {
      $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
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
                  <img src="<?php echo $profilepicPath?>" width="30" height="30" class="rounded-circle" alt="default-pic">
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
      <h1 class="display-4">Report An Issue</h1>
      <p class="lead">We are pleased to solve any problems!</p>
    </div>
  </header>
  <main class="px-5">
    <div>
      <?php
      if (isset($_SESSION['report_status']) && isset($_SESSION['report_num'])) {
          echo '<div class="container px-5"><div class="alert alert-success pb-0" id="success-alert">';
          echo '<h5>Report <strong>' . $_SESSION['report_num'] . '</strong> ' . $_SESSION['report_status'] . ' successfully.</h5>';
          echo '</div></div>';
          unset($_SESSION['report_status']);
          unset($_SESSION['report_num']);
      }
      ?>
      <div class="text-center bg-white">
        <span class="btn btn-outline-secondary btn-lg mx-auto border" id="nrbutton" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="border: 1px solid #7289da !important;">+ New Report</span>
      </div>
      <div class="container">
        <div class="collapse" id="collapseExample">
          <div class="card card-body mt-5">
            <form id="form" method="post" action="updatereport.php" enctype="multipart/form-data">
              <!-- action="newReport.php" method="post" -->
              <div class="form-group row">
                <label for="inputEmail3" class="col-md-2 col-form-label mt-2 text-md-right">Problem
                  Type</label>
                <div class="col-md-10 my-2">
                  <select class="form-control select2 select2-hidden-accessible" name="type" id="type" style="width: 100%;" required="" tabindex="-1" aria-hidden="true">
                    <!-- <option value="" selected="selected">- Problem Type -</option> -->
                    <?php
                    $sql = 'SELECT * FROM problemtype ORDER BY typeName';
                    $res = $conn->query($sql) or die($conn->error);
                    while ($row = $res->fetch_assoc()) {
                        echo '<option value="' . $row['typeName'] . '"> ' . $row['typeName'] . ' </option>';
                    }
                    ?>
                  </select>
                </div>
                <label for="exampleFormControlTextarea1" class="col-md-2 col-form-label mt-2 text-md-right">Problem
                  Details</label>
                <div class="col-md-10 my-2">
                  <textarea class="form-control" id="exampleFormControlTextarea1" name="details" rows="3" placeholder="Please describe your problem" required></textarea>
                </div>
                <label for="exampleInputPassword1" class="col-md-2 col-form-label mt-2 text-md-right">Mobile
                  Phone Num.</label>
                <div class="col-md-10 my-2">
                  <input type="text" class="form-control mx-0" name="phoneNumber" id="tel" placeholder="Enter mobile phone number" required="" style="width:100%;">
                </div>
                <label for="exampleInputPassword1" class="col-md-2 col-form-label mt-2 text-md-right">Problem
                  Location</label>
                <div class="col-md-10 my-2">
                  <textarea name="location" rows="3" class="form-control" id="hd_location" placeholder="Please describe your problem location" required=""></textarea>
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
                  <button type="submit" id="submitReport" name="create" value="create" class="btn btn-primary">Submit</button>
                  <button type="danger" class="btn btn-danger btn-sm m-1" href="#collapseExample" aria-expanded="true" aria-controls="collapseExample">Cancel</button>
                </div>

              </div>
            </form>
            <div class="text-center">
              <a class="text-secondary" data-toggle="collapse" href="#collapseExample" aria-expanded="true" aria-controls="collapseExample"><u>Hide window</u></a>
            </div>
          </div>
        </div>
      </div>
      <br>
      <hr class="mt-4 mb-0 pb-0">
      <div class="row pr-lg-5 pl-lg-4 pb-4 pt-0 mt-0">
        <div class="col-lg-2 pt-0 pt-lg-3 sticky-top">
          <div class="my-2 my-lg-4 mr-lg-3 ml-lg-0 pl-lg-0 sticky-top">
            <div class="nav nav-pills d-flex flex-row d-lg-block text-center text-lg-left" id="pills-tab" role="tablist">
              <a class="nav-link active col-6 col-lg-12" id="v-pills-overview-tab" data-toggle="pill" href="#v-pills-overview" role="tab" aria-controls="v-pills-overview" aria-selected="true">Overview</a>
              <a class="nav-link col-6 col-lg-12" id="v-pills-yreport-tab" data-toggle="pill" href="#v-pills-yreport" role="tab" aria-controls="v-pills-yreport" aria-selected="false">Your Report</a>
            </div>
          </div>
          <div class="d-block d-lg-none border-bottom"></div>
        </div>
        <div class="col-lg-10 pt-4 border-left">
          <div class="tab-content ml-lg-3 p-3" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-overview" role="tabpanel" aria-labelledby="v-pills-overview-tab">
              <div class="row">
                <div class="col-12 mb-3">
                  <div class="card">
                    <div class="row pt-3 pr-3" id="cases">
                      <div class="col-4" style="color:red;">
                        <div>
                          <h5 style="font-size:17px;">Pending</h5>
                        </div>
                      </div>
                      <div class="col-4" style="color: rgb(182, 182, 30)">
                        <div>
                          <h5 style="font-size:17px;">In Progress</h5>
                        </div>
                      </div>
                      <div class="col-4" style="color: green">
                        <div>
                          <h5 style="font-size:17px;">Completed</h5>
                        </div>
                      </div>
                      <div class="col-4" style="color:red;">
                        <div>
                          <h1 class="newCases">
                            <?php
                            $sql = 'SELECT * FROM report WHERE problemStatus="Pending" AND month(ticketDate)=' . $currentMonth;
                            $result = $conn->query($sql) or die($conn->error);
                            echo $result->num_rows;
                            ?>
                          </h1>
                        </div>
                      </div>
                      <div class="col-4" style="color: rgb(182, 182, 30)">
                        <div>
                          <h1 class="solvingCases">
                            <?php
                            $sql = 'SELECT * FROM report WHERE problemStatus="In Progress" AND month(ticketDate)=' . $currentMonth;
                            $result = $conn->query($sql) or die($conn->error);
                            echo $result->num_rows;
                            ?>
                          </h1>
                        </div>
                      </div>
                      <div class="col-4" style="color: green">
                        <div>
                          <h1 class="solvedCases">
                            <?php
                            $sql = 'SELECT * FROM report WHERE problemStatus="Completed" AND month(ticketDate)=' . $currentMonth;
                            $result = $conn->query($sql) or die($conn->error);
                            echo $result->num_rows;
                            ?>
                          </h1>
                        </div>
                      </div>
                      <div class="col-12 mb-1 font-italic ml-1"><small>Reset Monthly</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-3 mb-md-0">
                  <div class="card" style="height: 100%;">
                    <div class="card-header pb-0">
                      <h5>Reporter of the Month</h5>
                    </div>
                    <div class="card-body">
                      <div>
                        <?php
                        $sql = 'SELECT matricNo, count(matricNo) AS "num" FROM report WHERE month(ticketDate)=' . $currentMonth . ' GROUP BY matricNo ORDER BY num DESC';
                        $result = $conn->query($sql) or die($conn->error);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $rotm = $row['matricNo'];
                            $num = $row['num'];
                            $res = $conn->query('SELECT * FROM student WHERE matricNo="' . $rotm . '"') or die($conn->error);
                            $row = $res->fetch_assoc();
                            if (!($row['profilepicPath']==null || $row['profilepicPath']=='')) {
                                echo '<img src="'.$row['profilepicPath'].'">';
                            }
                            echo '<h5 class="card-title text-lg-left text-md-center text-sm-left text-center">'
                            . $row['fullname'] .
                            '</h5>';
                            echo '<p class="card-text"></p>
                          <ul class="ml-3">
                            <li>Number of report(s): ' . $num . '</li>
                          </ul>
                        </p>';
                        } else {
                            echo '<h5 class="card-title text-lg-left text-md-center text-sm-left text-center">
                          No entry.
                          </h5>';
                        }

                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 pl-0">
                  <div class="card text-center  ml-3 ml-md-0" style="height: 100%;">
                    <div class="card-header pb-0">
                      <h5>Monthly Issues</h5>
                    </div>
                    <div class="card-body">
                      <ul class="list-group list-group-flush" style="background-color: transparent;">
                        <?php
                        $sql = 'SELECT problemType, count(problemType) AS "num" FROM report WHERE month(ticketDate)=' . $currentMonth . ' GROUP BY problemType ORDER BY num DESC, problemType ASC';
                        $result = $conn->query($sql) or die($conn->error);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li class="list-group-item">' . $row['problemType'] . '</li>';
                            }
                        } else {
                            echo '<h5 class="card-title text-lg-left text-md-center text-sm-left text-center">
                          No entry.
                          </h5>';
                        }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="v-pills-yreport" role="tabpanel" aria-labelledby="v-pills-yreport-tab">
              <div class="d-block pb-1 text-dark text-right">
                <div>
                  <a style="color: black; font-size: 18px;" data-toggle="collapse" href="#editColumn" aria-expanded="false" aria-controls="editColumn" onclick="if(this.innerHTML =='Edit'){this.innerHTML = 'Done'}else{this.innerHTML = 'Edit'}">Edit</a>
                </div>
              </div>
              <div class="scrollmenu card">
                <table class="table table-bordered text-center mb-0" style="border-radius: 0.35rem;" id="report-table">
                  <tr class=" text-center card-header">
                    <th>Ticket No.</th>
                    <th>Problem Type</th>
                    <th>Status</th>
                    <th>Ticket Date</th>
                    <th class="collapse" id="editColumn" style="border:1px;">Edit</th>
                  </tr>
                  <?php
                  $sql = 'SELECT * FROM  report WHERE matricNo="' . $_SESSION['user_id'] . '" ORDER BY ticketDate DESC, ticketTime DESC';
                  $result = $conn->query($sql) or die($conn->error);
                  if ($result->num_rows > 0) {
                      for ($i = 0; $i < $result->num_rows; $i++) {
                          $row = $result->fetch_assoc();
                          $ps = $row['problemStatus'];
                          $ticketNo = $row['ticketNo'];
                          $problemType = $row['problemType'];
                          $ticketDate = substr($row['ticketDate'], 0, 10);
                          $badge = '';
                          if ($ps == 'Pending') {
                              $badge = 'info';
                          } elseif ($ps == 'In Progress') {
                              $badge = 'warning';
                          } else {
                              $badge = 'success';
                          } ?>
                      <tr>
                        <td><?= $ticketNo ?></td>
                        <td><?= $problemType ?></td>
                        <td><span class="badge badge-<?= $badge ?>"><?= $ps ?></span></td>
                        <td><?= $ticketDate ?></td>
                        <?php if ($ps == 'Pending') { ?>
                          <td class="collapse my-auto py-auto" id="editColumn" 
                          style="border-width:<?php if ($i==0) {
                              echo '0';
                          } else {
                              echo '1';
                          }?>px 0px 0px 0px;">
                            <!-- collapse -->
                            <div class="d-flex flex-row justify-content-center">
                              <form class="px-0 mx-0" method="post" action="editreport.php">
                                <button href="#!" class="btn m-0 p-0 mr-1" name="ticketNo" value="<?= $ticketNo ?>" style="background-color: transparent;">
                                  <i class="fa fa-edit pt-1" style="font-size:30px;" aria-hidden="true"></i>
                                </button>
                              </form>
                              <button href="#!" class="btn delete m-0 p-0 ml-1" data-toggle="modal" data-target="#deleteModal<?= $i ?>" style="background-color: transparent;">
                                <i class="fa fa-trash my-auto" style="font-size:30px;" aria-hidden="true"></i>
                              </button>
                            </div>
                            <div class="modal fade" id="deleteModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content pb-0 mt-5" style="width:300px;">
                                  <div class="modal-body pb-0">
                                    <p style="font-weight:bold;">Are you sure you want to <br>delete report <?= $ticketNo ?>?</p>
                                  </div>
                                  <div class="modal-footer d-flex flex-row">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form method="post" action="updatereport.php"><button type="submit" name="delete" value="<?= $ticketNo ?>" class="btn btn-primary">Delete</button></form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        <?php  } else { ?>
                          <td class="collapse" id="editColumn">
                            <div class="disabled-delete">&nbsp;
                            </div>
                          </td>
                    <?php
                        }
                          echo '</tr>';
                      }
                  }
                    ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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