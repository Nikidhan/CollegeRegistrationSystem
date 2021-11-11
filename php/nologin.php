<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


  <link rel="stylesheet" type="text/css" href="../css/login.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script> -->


  <title>Homepage</title>

</head>

<body>

  <header>
    <div class="jumbotron text-center mb-0">
      <br><br>

      <h1 class="display-4 ml16">Access Denied</h1>
      <h1 class="display-5">Go <a href="home.php" style="color:yellow;">home</a> user, you're not logged in.
      </h1>

    </div>

  </header>


  <!-- Content -->
  <div class="d-flex flex-column justify-content-center p-4" style="background-image: url(' https://drive.google.com/uc?id=1jQrIoXmo_QRBgVFXRnT1b5-zwMQ5EEdP&export=download'); background-position: center;
    background-size: cover; border-top: 20px solid white !important; border-bottom: 20px solid white !important;">
    <div class="text-center text-dark my-3" style="font-size: 16px; font-weight: 600;letter-spacing: 5px;text-transform: uppercase;">ANNOUNCEMENTS
    </div>
    <?php include('slideshow.php'); ?>
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
  <script type='text/javascript' src='http://code.jquery.com/jquery-2.0.2.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

  <script>
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
  </script>
  <script>
    $(window).scroll(function() {
      $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
    });
    $(window).scroll(function() {
      $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
    });
    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    });
  </script>

  <script type="text/javascript">
    $("#about").click(function() {
      $('html,body').animate({
        scrollTop: $("#about-us").offset().top
      }, 1000);
    });
  </script>


</body>

</html>