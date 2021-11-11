<?php
session_start();
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){ $protocol = "https://".$_SERVER['HTTP_HOST']; } else{ $protocol='http://'.$_SERVER['HTTP_HOST']; }
header("Access-Control-Allow-Origin: *");
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


  <link rel="stylesheet" type="text/css" href="../css/login.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie" type="text/css">
  <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script> -->


  <title>Homepage</title>

</head>

<body>

  <header>
    <div class="jumbotron text-center mb-0">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-0">
        <a class="navbar-brand py-0" href="#"><img src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download" width="40" height="40" alt="kk8 logo"></a>
        <!-- This button appear at the navbar when the user make the browser smaller -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- 	This navbar dissapear when the user make the browser smaller -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <!-- Items in the navbar can be included in the list -->
          <ul class="navbar-nav my-0 py-0">
            <li class="nav-item">
              <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="about">About</a>
            </li>

          </ul>
          <ul class="navbar-nav ml-auto py-0">
            <li class="nav-item my-1">
              <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ModalLogin">Login</button>
            </li>
          </ul>
      </nav>
      <br><br>
      <h1 class="display-5">Welcome to</h1>
      <h1 class="display-4 ml16">Kinabalu Residential College</h1>
      
    </div>

  </header>


  <!-- Content -->
  <div class="d-flex flex-column justify-content-center p-4" style="background-image: url(' https://drive.google.com/uc?id=1jQrIoXmo_QRBgVFXRnT1b5-zwMQ5EEdP&export=download'); background-position: center;
    background-size: cover; border-top: 20px solid white !important; border-bottom: 20px solid white !important;">
    <div class="text-center text-dark my-3" style="font-size: 16px; font-weight: 600;letter-spacing: 5px;text-transform: uppercase;">ANNOUNCEMENTS
    </div>
    <?php include('slideshow.php');?>
  </div>

  <div class="jumbotron text-center p-4 mb-1" style="background-color: white;">
    <h1 class="mb-4" style="font-size: 16px;font-weight: 600;letter-spacing: 5px;text-transform: uppercase;">
      Featured videos</h1>
    <div class="row">
      <div class="col-lg-6 mb-3 mb-lg-0 px-0 pr-lg-2">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" width="720" height="480" src="https://www.youtube.com/embed/BZRU1RiL_58" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
      <div class="col-lg-6 px-0 pl-lg-2">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" width="720" height="480" src="https://www.youtube.com/embed/ulUDcPr883s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>

    <div class="jumbotron p-5 my-5" style="background-image: url('https://drive.google.com/uc?id=1iw5YTW1b5wzOB5g6KvaK9idh2oaqjOCo&export=download');color: white; background-position: center;
                background-size: cover;" id="about-us">
      <div class="container-fluid mx-auto my-3">
        <h1 class="display-5" style="text-align: left;">
          About us</h1>
        <p class="font-weight-light" style="text-align: left; font-size: 15px;">Kinabalu is the 8th
          Residential College in the University of Malaya.<br>The establishment of college was on 1985 and
          it was officially opened on 18th of December 1987. <br>The funding of the college was fully paid
          by Yayasan Sabah (Sabah Foundation).</p>

      </div>

    </div>


    <style>
      /* Set the size of the div element that contains the map */
      #map {
        height: 300px;
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>

    <div class="d-flex my-5" id="map"></div>
    <script>
      // Initialize and add the map
      function initMap() {
        // The location 3.129989, 101.649348
        var kk8 = {
          lat: 3.129989,
          lng: 101.649348
        };
        // The map, centered at place
        var map = new google.maps.Map(
          document.getElementById('map'), {
            zoom: 18,
            center: kk8
          });
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({
          position: kk8,
          map: map
        });
      }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCvLnDkcu8HzrrEqpIFdhqYIg2BTTRw1zs&callback=initMap">
    </script>

  </div>

  <style>
  .status-available {
    color: green;
  }

  .status-not-available {
      color: red;
  }
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    border: 1px solid #888;
    width: 100%;
  }
  </style>

  <!---- Login Popup --->
  <div class="modal fade" id="ModalLogin" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header d-flex flex-column">
          <button type="button" class="close p-0" data-dismiss="modal">&times;</button>
          <img src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download" alt="Avatar" class="avatar mx-auto">
          <h3 class="modal-title mx-auto">Login</h3>
        </div>
        <div class="modal-body">
          <form id="loginForm" action="processLogin.php" method="POST">
            <div class="form-group">
              <i class="fa fa-user icon"></i>
              <input type="text" name="matricNo" class="form-control" placeholder="Matric Number" required>
            </div>
            <div class="form-group">
              <i class="fa fa-lock icon"></i>
              <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <!-- <div class="form-group">
              <a data-toggle="modal" href="#ModalForgotPassword" class="pull-right" data-dismiss="modal" style="float: right;">Forgot password ?</a>
              <div class="clearfix"></div>
            </div> -->
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg full" id="newSubmit">Sign In</button>
            </div>
          </form>
        </div>
        <a href="#ModalSignup" data-toggle="modal" data-dismiss="modal" style="text-align:center; padding-bottom: 20px;">Create an account</a>
      </div>
    </div>
  </div>
  <!---- Login Popup --->
  
  <!-- Login fail popup--->
  <div class="modal hide fade p-0" tabindex="-1" role="dialog" id="loginfail">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="alert bg-white m-0" role="alert">
          &nbsp;<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <br><h5 style="color: #5c0009;"><strong>Invalid matric number or password! Please login again</strong></h5><br>&nbsp;
          <button class="btn" href="#ModalLogin" data-toggle="modal" data-dismiss="modal">Login</button>
        </div>
      </div>
    </div>
  </div>

  <!---- Signup Popup --->
  <div class="modal fade" id="ModalSignup" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header d-flex flex-column">
          <button type="button" class="close p-0" data-dismiss="modal">&times;</button>
          <img src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download" alt="Avatar" class="avatar mx-auto">
          <h3 class="modal-title mx-auto">Sign Up</h3>
        </div>
        <div class="modal-body">
          <form id="signupForm" action="processSignup.php" method="POST">
            <div class="form-group">
              <i class="fa fa-user icon"></i>
              <input type="text" name="matricNo" id="matricNo" class="form-control" placeholder="Matric Number" required><span id="matric-availability-status"></span>
            </div>
            <div class="form-group">
              <i class="fa fa-user icon"></i>
              <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="form-group">
              <i class="fa fa-envelope icon"></i>
              <input type="email" name="email" id="email" class="form-control" placeholder="Siswamail" required><span id="email-availability-status"></span>
            </div>
            <div class="form-group">
              <i class="fa fa-lock icon"></i>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
              <i class="fa fa-lock icon"></i>
              <input type="password" name="rpassword" id="rpassword" class="form-control" placeholder="Confirm password" required>
              <span id='message'></span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg full" id="signupButton" value="Submit">Sign Up</button>
            </div>
          </form>
        </div>
        <a href="#ModalLogin" data-toggle="modal" data-dismiss="modal" style="text-align:center; padding-bottom: 20px;">Back to login</a>
      </div>
    </div>
  </div>
  <!---- SignUp Popup --->

<!-- SignUp Succ--->
<div class="modal hide fade p-0" tabindex="-1" role="dialog" id="newRegister">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="alert bg-white m-0" role="alert">
        &nbsp;<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <br><h5 style="color: #0c570c"><strong>Registration Successful! Login to continue</strong></h5><br>&nbsp;
        <button class="btn" href="#ModalLogin" data-toggle="modal" data-dismiss="modal">Login</button>
      </div>
    </div>
  </div>
</div>

  <!---- Forgot Password Popup --->
  <!-- <div class="modal fade" id="ModalForgotPassword" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header d-flex flex-column">
          <button type="button" class="close p-0" data-dismiss="modal">&times;</button>
          <img src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download" alt="Avatar" class="avatar mx-auto">
          <h3 class="modal-title mx-auto">Forgot Password</h3>
        </div>
        <div class="modal-body">
          <form>
            <div><label for="exampleInputEmail1">Enter your email address to reset password</label>
            </div>
            <div class="form-group">
              <i class="fa fa-envelope icon"></i>
              <input type="email" class="form-control" id="exampleInputEmai1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <a href="#ModalLogin" data-toggle="modal" data-dismiss="modal" style="text-align:center; padding-bottom: 20px;">Back to login</a>
      </div>
    </div>
  </div> -->
  <!---- Forgot Password Popup --->

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

  <!-- Bootstrap JS source file link -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script type='text/javascript' src='https://code.jquery.com/jquery-2.0.2.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

  <script>

    var matricokay = false;
    var emailokay = false;
    var passwordokay = false;
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml16');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({
        loop: true
      })
      .add({
        targets: '.ml16 .letter',
        translateY: [-100, 0],
        easing: "easeOutExpo",
        duration: 1400,
        delay: (el, i) => 30 * i
      }).add({
        targets: '.ml16',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 10000
      });
  
    $(window).scroll(function() {
      $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
    });
    $(window).scroll(function() {
      $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
    });
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    });
  
    $("#about").click(function() {
      $('html,body').animate({
        scrollTop: $("#about-us").offset().top
      }, 1000);
    });
  
    $(document).ready(function() {
      var typingTimer; //timer identifier
      var doneTypingInterval = 300; //time in ms, 5 second for example
      var $input = $('#matricNo');

      //on keyup, start the countdown
      $input.on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
      });

      //on keydown, clear the countdown 
      $input.on('keydown', function() {
        clearTimeout(typingTimer);
        $("#matric-availability-status").html('');
      });


      //user is "finished typing," do something
      function doneTyping() {
        if ($input.val() != "") {
        //check if matric no already registered
          jQuery.ajax({
            url: "check_availability.php",
            data: 'matricNo=' + $("#matricNo").val(),
            type: "POST",
            success: function(data) {
              if (data == 0) {
                $("#matric-availability-status").html("<span class='status-not-available'> Matric number already registered.</span>");
                matricokay = false;
                registerSuccess();
              } else {
                matricokay = true;
                registerSuccess();
              }
            },
            error: function() {}
          });
        };
      };
    });

    $(document).ready(function() {
      var typingTimer; //timer identifier
      var doneTypingInterval = 300; //time in ms, 5 second for example
      var $input = $('#email');

      //on keyup, start the countdown
      $input.on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
      });

      //on keydown, clear the countdown 
      $input.on('keydown', function() {
        clearTimeout(typingTimer);
        $("#email-availability-status").html('');
      });


      //user is "finished typing," do something
      function doneTyping() {
        if ($input.val() != "") {
        //check if email already registered
          jQuery.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function(data) {
              if (data == 0) {
                $("#email-availability-status").html("<span class='status-not-available'> Siswamail already registered.</span>");
                emailokay = false;
                registerSuccess();
              } else {
                emailokay = true;
                registerSuccess();
              }
            },
            error: function() {}
          });
        };
      };
    });

    // check if password match or not
    $('#password, #rpassword').on('keyup', function () {
      if($('#rpassword').val() != ""){
        if ($('#password').val() == $('#rpassword').val()) {
          $('#message').html('Matching').css('color', 'green');
          passwordokay = true;
          registerSuccess();
        } else {
          $('#message').html('Not Matching').css('color', 'red');
          passwordokay = false;
          registerSuccess();
        }
      } else if ($('#password').val() == "" || $('#rpassword').val() =="") {
            $('#message').html('');
      }
    });

    function registerSuccess() {
      if (matricokay && emailokay && passwordokay) {
        document.getElementById("signupButton").disabled = false;
      } else {
        document.getElementById("signupButton").disabled = true; 
      }
    };
  </script>
  <?php
  if (isset($_SESSION['fail_login'])) {
      echo '<script type="text/javascript">
    $(document).ready(function() {
      $(\'#loginfail\').modal(\'show\');
    });
    </script>';
      unset($_SESSION['fail_login']);
  }
  
  if (isset($_SESSION['new_register'])) {
      echo '<script type="text/javascript">
    $(document).ready(function() {
      $(\'#newRegister\').modal(\'show\');
    });
    </script>';
      unset($_SESSION['new_register']);
  }
  ?>

</body>

<?php

session_destroy();
?>
</html>
