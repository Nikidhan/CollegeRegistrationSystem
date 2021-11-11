<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}
include_once('config.php');

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
        <title>Food Menu</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Override Bootstrap CSS with custom CSS file -->
        <!-- <link rel="stylesheet" type="text/css" href="../css/login.css"> -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>
        
        <link rel="stylesheet" href="../css/food.css">
        <!-- JQuery -->
        <script>
            $(window).scroll(function () {
                $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
            });
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        </script>

        <script>
            $(window).scroll(function () {
                $('nav').toggleClass('scrolled', $(this).scrollTop() > 75);
            })
        </script>

        <style type="text/css">
            .codecolour {
                background-color: #7289da;
                color: white;
            }
        </style>

    </head>

    <body>
        <header>
            <div class="jumbotron text-center">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-0">
                    <a class="navbar-brand" href="#"><img
                            src="https://drive.google.com/uc?id=1ANPwmvZ9bZPQjywWeXCLm56GNkuzQJEX&export=download"
                            width="40" height="40" alt="kk8 logo"></a>
                    <!-- This button appear at the navbar when the user make the browser smaller -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!--  This navbar dissapear when the user make the browser smaller -->
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
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo $profilepicPath ?>" width="30" height="30" class="rounded-circle" alt="default-pic">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="manage.php">Manage Profile</a>
                                        <a class="dropdown-item" href="logout.php">Log Out</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </nav>
                <br><br>
                <h1 class="display-4">Order Your Food!</h1>
                <p class="lead">We will provide healthy foods with sufficient nutrients for our residents</p>
        </header>
        <!-- View food menu and order food for next two weeks at residential college, cancel food ordering -->

        <?php
            
        ?>

        <main>
            <div class="jumbotron mt-3 ">
                <form method="POST" action="FoodOrder.php">

                    <!-- Menu Container -->
                    <div class="w3-content">
                        <div class="form-group row">
                            <label for="Deliverydate" class="col-2 col-form-label">Delivery date:</label>
                            <div class="col-3">
                                <!-- <input class="form-control" type="date" min = "2020-01-01" max="2020-09-09" id="deliveryDate"> -->
                                <input class="min-today form-control" name ="date" id="myDate" id="min max" value="2020-06-15" type="date" placeholder="YYYY-MM-DD"
                                    data-date-split-input="true" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="DeliveryTime" class="col-2 col-form-label">Delivery time :</label>
                            <div class="col-3">
                                <select id="times" name="time" class="form-control" required>
                                    <option value="">--delivery time--</option>
                                    <option value="8.00am - 9.00am">8.00am - 9.00am</option>
                                    <option value="12.00pm - 1.00pm">12.00pm - 1.00pm</option>
                                    <option value="6.00pm - 7.00pm">6.00pm - 7.00pm</option>
                                </select>
                            </div>
                        </div>
                        <p>You can place your future orders up to 14 days in advance</p>
                        <h2 class="w3-center" id="menu"><strong>THE MENU</strong></h2>
                        <div class="w3-row w3-center w3-border w3-border-dark-grey bg-light-grey">
                            <a href="javascript:void(0)" onclick="openMenu(event, 'Main Dish');" id="myLink">
                                <div class="w3-col s3 tablink w3-padding-large w3-hover-codecolour">Main Dish</div>
                            </a>
                            <a href="javascript:void(0)" onclick="openMenu(event, 'Side Dish');">
                                <div class="w3-col s3 tablink w3-padding-large w3-hover-codecolour">Side Dish</div>
                            </a>
                            <a href="javascript:void(0)" onclick="openMenu(event, 'Desserts');">
                                <div class="w3-col s3 tablink w3-padding-large w3-hover-codecolour">Desserts</div>
                            </a>
                            <a href="javascript:void(0)" onclick="openMenu(event, 'Drinks');">
                                <div class="w3-col s3 tablink w3-padding-large w3-hover-codecolour">Drinks</div>
                            </a>
                        </div>

                            <div id="Main Dish" class="w3-container menu w3-padding-32 w3-white">

                                <input id="menu" type="checkbox" value="Nasi Kandar" name = "food[]" >
                                <label for="Nasi Kandar"><h5><b>Nasi Kandar</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Nasi Kandar,">RM9.50</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Nasi Kandar" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">fried chicken, gizzards, curry mutton, cubed beef</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Banana Leaf" name = "food[]" >
                                <label for="Banana Leaf"><h5><b>Banana Leaf</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Banana Leaf,">RM7.50</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="quantity col-2">
                                        <select name="quantity[]" id="Banana Leaf" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">curried meat/fish, pickles, papadum</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Nasi Lemak" name = "food[]">
                                <label for="Nasi Lemak"><h5><b>Nasi Lemak</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Nasi Lemak,">RM3.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Nasi Lemak" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Fried anchovies, sambal, boiled egg, cucumber, peanuts</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Nasi Dagang" name = "food[]" >
                                <label for="Nasi Dagang"><h5><b>Nasi Dagang</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Nasi Dagang,">RM5.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Nasi Dagang" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Curry made with ikan tongkol, acar timun, hard-boiled egg
                                </p>
                                <hr>

                                <input id="menu" type="checkbox" value="Asam Laksa" name = "food[]" >
                                <label for="Asam Laksa"><h5><b>Asam Laksa</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Asam Laksa,">RM5.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Asam Laksa" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">tamarind juice, chilli, mint leaves, lemongrass</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Mee jawa" name = "food[]" >
                                <label for="Mee jawa"><h5><b>Mee Jawa</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Mee jawa,">RM5.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Mee jawa" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">tofu, sweet potatoes, bean sprouts, half-boiled egg, fried
                                    onions</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Ayam Percik" name = "food[]" >
                                <label for="Ayam Percik"><h5><b>Ayam Percik</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Ayam Percik,">RM7.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Ayam Percik" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">white rice, salad</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Nasi Goreng" name = "food[]" >
                                <label for="Nasi Goreng"><h5><b>Nasi Goreng</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Nasi Goreng,">RM5.50</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Nasi Goreng" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Fried anchovies</p>
                                <hr>


                            </div>

                             <div id="Side Dish" class="w3-container menu w3-padding-32 w3-white">

                                <input id="menu" type="checkbox" value="Roti Canai" name = "food[]">
                                <label for="Roti Canai"><h5><b>Roti Canai</b> </h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Roti Canai,">RM1.50</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Roti Canai" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Fish curry/Dal(lentil based soup)</p>
                                <hr>

                               <input id="menu" type="checkbox" value="Kaya Toast" name = "food[]">
                                <label for="Kaya Toast"><h5><b>Kaya Toast Set</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Kaya Toast,">RM5.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Kaya Toast" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Half-boiled egg, Coffee</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Tosai" name = "food[]">
                                <label for="Tosai"><h5><b>Tosai</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Tosai,">RM3.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Tosai" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Yogurt/Curry</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Roti Jala" name = "food[]">
                                <label for="Roti Jala"><h5><b>Roti Jala</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Roti Jala,">RM5.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Roti Jala" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">chicken curry with potatoes</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Porridge" name = "food[]">
                                <label for="Porridge"><h5><b>Porridge</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Porridge,">RM3.50</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Porridge" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">White pepper, soy sauce, sesame oil</p>

                                <input id="menu" type="checkbox" value="Garlic bread" name = "food[]">
                                <label for="Garlic bread"><h5><b>Garlic bread</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Garlic bread,">RM3.50</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Garlic bread" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Grilled ciabatta, garlic butter, onions</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Otak otak" name = "food[]">
                                <label for="Otak otak"><h5><b>Otak otak</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Otak otak,">RM1.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Otak otak" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">steamed seafood mousse</p>
                                <hr>
                            </div>


                            <div id="Desserts" class="w3-container menu w3-padding-32 w3-white">

                                <input id="menu" type="checkbox" value="Ais Kacang" name = "food[]">
                                <label for="Ais Kacang"> <h5><b>Ais Kacang</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Ais Kacang,">RM3.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Ais Kacang" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">sweet corn kernels, red beans, grass jelly, cendol, peanuts,
                                    ice
                                    cream</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Aiskrim potong" name = "food[]">
                                <label for="Aiskrim potong"><h5><b>Aiskrim potong</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Aiskrim potong,">RM1.50</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Aiskrim potong" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">red beans/rose syrup/durian/pandan/cream corn</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Batik Cake" name = "food[]">
                                <label for="Batik Cake"><h5><b>Batik Cake</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Batik Cake,">RM1.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Batik Cake" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">marie biscuit, milo, chocolate</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Bubur Kacang hijau" name = "food[]">
                                <label for="Bubur Kacang hijau"><h5><b>Bubur Kacang hijau</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Bubur Kacang hijau,">RM3.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Bubur Kacang hijau" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">cane sugar, coconut milk</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Dodol" name = "food[]">
                                <label for="Dodol"><h5><b>Dodol</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Dodol,">RM2.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Dodol" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">coconut milk, jaggery, rice flour</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Dadih" name = "food[]">
                                <label for="Dadih"><h5><b>Dadih</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Dadih,">RM2.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Dadih" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">custard like texture</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Cendol" name = "food[]">
                                <label for="Cendol"><h5><b>Cendol</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Cendol,">RM2.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Cendol" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">coconut milk, gula melaka</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Pisang Goreng" name = "food[]">
                                <label for="Pisang Goreng"><h5><b>Pisang Goreng</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Pisang Goreng,">RM1.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Pisang Goreng" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey"></p>
                                <hr>

                                <input id="menu" type="checkbox" value="Keropok Lekor" name = "food[]">
                                <label for="Keropok Leko"><h5><b>Keropok Lekor</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Keropok Lekor,">RM1.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Keropok Lekor" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey"></p>
                                <hr>

                            </div>

                            <div id="Drinks" class="w3-container menu w3-padding-32 w3-white">

                                <input id="menu" type="checkbox" value="Teh Tarik" name = "food[]">
                                <label for="Teh Tarik"><h5><b>Teh Tarik</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Teh Tarik,">RM2.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Teh Tarik" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">mixture of black tea with condensed or evaporated milk</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Sirap Bandung" name = "food[]">
                                <label for="Sirap Bandung"><h5><b>Sirap Bandung</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Sirap Bandung,">RM2.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Sirap Bandung" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey"> Rose flavored syrup is mixed together with condensed or
                                    evaporated milk</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Kit Chai Ping" name = "food[]">
                                <label for="Kit Chai Ping "><h5><b>Kit Chai Ping </b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Kit Chai Ping,">RM2.50</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Kit Chai Ping" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Kalamansi limes, sugar syrup, water and the Chinese salted
                                    sour
                                    plums which the locals call Ham Moi</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Teh halia" name = "food[]">
                                <label for="Teh halia"><h5><b>Teh halia</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Teh halia,">RM2.50</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Teh halia" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Teh tarik with a hint of ginger.</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Teh O ais limau" name = "food[]">
                                <label for="Teh O ais limau"><h5><b>Teh O ais limau</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Teh O ais limau,">RM3.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Teh O ais limau" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Ice tea with a splash of lime.</p>
                                <hr>

                                <input id="menu" type="checkbox" value="Milo ais" name = "food[]">
                                <label for="Milo ais"><h5><b>Milo ais</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Milo ais,">RM3.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Milo ais" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey"></p>
                                <hr>

                                <input id="menu" type="checkbox" value="Limau ais" name = "food[]">
                                <label for="Limau ais"><h5><b>Limau ais</b></h5></label><br>
                                <span class="w3-right w3-tag codecolour w3-round" id="Limau ais,">RM3.00</span>
                                <div class="form-group row ">
                                    <label class="col-1 col-form-label">Quantity: </label>
                                    <div class="col-2">
                                        <select name="quantity[]" id="Limau ais" class="form-control">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <p class="w3-text-grey">Fresh lime with syrup on ice.</p>
                                <hr>

                            </div>
                            <br>

                    </div>
                    <br>
                    <div class="text-center">
                    <!-- <input class="submit" type="submit" name="submit" id="checkBtn" value="Confirm"> -->
                    <button type="button" class="submit" name ="review" data-toggle="modal" onclick="myFunction()" data-target="#Modalconfirm" id="checkBtn">Order</button>
                    </div> <!-- end of 'Submit' button -->
                
                    <div class="modal fade" id="Modalconfirm" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <button type="button" class="close" onclick="deletee()" data-dismiss="modal">&times;</button>
                                    <h3 class="modal-title">Food Review</h3>
                                </div>
                                <div class="modal-body">
                                    <p class="alert alert-info text-center"><small>Please make sure your order is correct before click on the <strong>CONFIRM</strong> button. If it is incorrect, please click on the 'x' button.</small></p>
                                    <p id="demo"></p>
                                    <p id="time"></p>
                                    <table id="myTable" style="width:100%;height: 100%">
                                        <tr style="background-color:#7289da; color:white">
                                            <th>Food</th>
                                            <th>Quantity</th>
                                            <th>Price for 1</th>
                                        </tr>
                                        </table>
                                        <br>
                                        <div class="form-group text-center">
                                            <input class="confirm" type="submit" name="submit" value="Confirm">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>    
            </div><!-- end of jumbotron -->
        </main>
        
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

        <style>
            .confirm {
                background-color: #7289da;
                border: none;
                color: white;
                padding: 7px 20px;
                font-size: 15px;
                margin: 2px 1px;
                border-radius: 6px
            }

            .modal {
                display: none;
                position: fixed;
                z-index: 10000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: auto;
                margin-top: 100px;
                border: 1px solid #888;
                width: 100%;
            }

            .modal-header {
                text-align: center;
                margin: 10px 12px;
                position: relative;
            }

            .modal-body {
                padding: 10px 40px;
            }

            table,
            th,
            td {
                border: 1px solid white;
                border-collapse: collapse;
                text-align: center;
            }
        </style>
        
        <script>
            function myFunction() {
                var table = document.getElementById("myTable");
                var dish = " ";
                dish = document.forms[0];
                var txt = " ";
                var i;
                for (i = 0; i < dish.length; i++) {
                    var row = table.insertRow(i+1);
                    if (dish[i].checked) {
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        txt = dish[i].value;
                        cell1.innerHTML = txt;
                        var quantity = document.getElementById(txt);
                        var foodQ = quantity.options[quantity.selectedIndex].value;
                        cell2.innerHTML = foodQ;
                        var price = document.getElementById(txt+",").innerText;
                        cell3.innerHTML = price;
                    }     
                }
                var d = document.getElementById("myDate").value;
                var x = document.getElementById("times").value;
                document.getElementById("demo").innerHTML = "Delivery date: "+d+"<br>Delivery time: "+x;
            }
            
            function deletee(){
                var tb = document.getElementById('myTable');
                while(tb.rows.length > 1) {
                tb.deleteRow(1);
            }
            }

            //choose at least one checkbox
            $(document).ready(function () {
                $('#checkBtn').click(function() {
                checked = $("input[type=checkbox]:checked").length;

                if(!checked) {
                    alert("You must check at least one checkbox.");
                    return false;
                }

                });
            });
            // Tabbed Menu
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
            }
            document.getElementById("myLink").click();

            // min days order
            $(function () {
                $(document).ready(function () {

                    var todaysDate = new Date(); // Gets today's date
                    var year = todaysDate.getFullYear(); // YYYY
                    var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2); // MM
                    var day = ("0" + (todaysDate.getDate()+1)).slice(-2); // DD

                    var minDate = (year + "-" + month + "-" +
                    day); // Results in "YYYY-MM-DD" for today's date 

                    // Now to set the max date value for the calendar to be today's date
                    $('[type="date"].min-today').attr('min', minDate);

                });
            });

            // max days order
            $(function () {
                $(document).ready(function () {
                    var todaysDate = new Date(); // Gets today's date
                    var year = todaysDate.getFullYear(); // YYYY
                    var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2); // MM
                    var day = ("0" + todaysDate.getDate()).slice(-2);
                    var minDate = (year + "-" + month + "-" + day);

                    var sdate = new Date(minDate);
                    var newdate = new Date(sdate);

                    newdate.setDate(newdate.getDate() + 14)

                    var y = newdate.getFullYear(); // YYYY
                    var m = ("0" + (newdate.getMonth() + 1)).slice(-2); // MM
                    var d = ("0" + newdate.getDate()).slice(-2);
                    var max = (y + "-" + m + "-" + d);
                    $('[type="date"].min-today').attr('max', max);
                });
            });
        </script>
    </body>
</html>