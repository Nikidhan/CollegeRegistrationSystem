<?php
    session_start();
    // echo $_SESSION['user_id'];
    include_once("config.php");

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
        <title>Food Order</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Override Bootstrap CSS with custom CSS file -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>

        <link rel="stylesheet" type="text/css" href="../css/food.css">

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
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo $profilepicPath ?>"
                                            width="30" height="30" class="rounded-circle" alt="default-pic">
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
                <h1 class="display-4">Scheduled Food Order</h1>
                <p class="lead">This is the order list of your food.</p>
            </div>
        </header>
        <main>
            <div class="jumbotron mt-3">
                <div class="container">
                    <p class="alert alert-info text-center"><small>Important note: Once status change to <strong>delivering</strong>, you can't cancel your order anymore. Please pay your food to the delivery guy later.
                            Thank you</small></p>
                            <?php
                                $matricNo = $_SESSION['user_id'];
                                // if (isset($_SESSION['logged_in']) && $_SESSION['user_id'] && $_SESSION['logged_in']==true) {
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    $date = $time = $quantity = $select = $totalprice = $status="";
                                    $newquantity[] = $newprice[] ="";
                                    if (!empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['food'])&& !empty($_POST['quantity'])) {
                                        try {
                                            $date = $_POST['date'];
                                            $time = $_POST['time'];

                                            $price = array(9.50,7.50,3.00,5.00,5.00,5.00,7.00,5.50,1.50,5.00,3.00,5.00,3.50,3.50,1.00,3.00,1.50,1.00,3.00,2.00,2.00,2.00,1.00,1.00,2.00,2.00,2.50,2.50,3.00,3.00,3.00);
                                            $newquantity = array(); //to store selected food quantity in array
                                            $newprice = array(); //to store price in array
                                            $newtotalprice = array(); //to store total price (price*quantity)

                                            //to store quantity and price in array that has same index as food
                                            $quantity = $_POST['quantity'];
                                            for ($j=0; $j< sizeof($quantity); $j++) {
                                                if (!empty($quantity[$j])) {
                                                    $newquantity[] = "$quantity[$j]";
                                                    $newprice[] = "$price[$j]";
                                                }
                                            }

                                            $select = $_POST['food'];
                                            for ($i=0; $i< sizeof($select); $i++) {
                                                if (empty($newquantity[$i])) {
                                                    (float)$price = 0;
                                                    (float)$totalprice += $price;
                                                } else {
                                                    (float)$price = (((float)$newquantity[$i])*((float)$newprice[$i]));
                                                    (float)$totalprice = (float)$totalprice+ (float)$price;
                                                }
                                            }

                                            $status = "pending";
                                            $f = implode("<br>", $select);
                                            $q = implode("<br>", $newquantity);
                                            $sql = "INSERT INTO food(`matricNo`,`foodName`,`deliveryDate`,`deliveryTime`,`quantity`,`totalPrice`,`foodStatus`) VALUES ('$matricNo','$f', '$date', '$time', '$q', '$totalprice','$status')";
                                            
                                            if ($conn->query($sql)==true) {
                                                echo '<script>alert("Congratulation! Your order has been recorded!")</script>';
                                            } else {
                                                echo "Error: ".$conn->error."<br><br>";
                                            }
                                        } catch (Exception $e) {
                                            echo "Caught exception: ".$e->getMessage();
                                        }
                                    } else {
                                        header("Location:foodMenu.php?action=incomplete_fields");
                                    }
                                }
                            // }

                                //update foodstatus
                                $dates = "SELECT deliveryDate FROM food WHERE matricNo = '$matricNo'";
                                $date = $conn->query($dates);
                                date_default_timezone_set("Asia/Kuala_Lumpur");
                                $todaydate = date("Y-m-d");
                                while ($row = $date->fetch_assoc()) {
                                    $deliveryDate = $row["deliveryDate"];
                                    if ($deliveryDate == $todaydate) { //if date selected is today food is delivering
                                        $sql = "UPDATE food SET foodStatus= 'delivering' WHERE deliveryDate = '$deliveryDate'";
                                        $update = $conn->query($sql);
                                    }
                                    if ($deliveryDate< $todaydate) { //if date selected is less than today food already delivered
                                        $sql = "UPDATE food SET foodStatus= 'completed' WHERE deliveryDate = '$deliveryDate'";
                                        $update= $conn->query($sql);
                                    }
                                    if ($deliveryDate> $todaydate) { //if date selected is less than today food already delivered
                                        $sql = "UPDATE food SET foodStatus= 'pending' WHERE deliveryDate = '$deliveryDate'";
                                        $update= $conn->query($sql);
                                    }
                                }

                                $display = "SELECT * FROM food WHERE matricNo = '$matricNo' ORDER BY deliveryDate DESC";
                                $result = $conn->query($display);
                                
                                if ($result->num_rows>0) {
                                    echo "<table style=\"width:100%;\">
                                                <tr style = \"background-color: #7289da;text-align:center;\">
                                                    <th>Food</th>
                                                    <th>Quantity</th>
                                                    <th>Delivery Date</th>
                                                    <th>Delivery time</th>
                                                    <th>Total price(RM)</th>
                                                    <th>Status</th>
                                                    <th>Cancel Order</th>
                                                </tr>";
                                    while ($row = $result->fetch_assoc()) {
                                        $foodID = $row["foodID"];
                                        $foodName = $row["foodName"];
                                        $quantity = $row["quantity"];
                                        $deliveryDate = $row["deliveryDate"];
                                        $deliveryTime = $row["deliveryTime"];
                                        $totalprice = $row["totalPrice"];
                                        $foodStatus = $row["foodStatus"];

                                        echo "<tr style = \"text-align:center;\">
                                                    <td>$foodName</td>
                                                    <td>$quantity</td>
                                                    <td>$deliveryDate</td>
                                                    <td>$deliveryTime</td>
                                                    <td>$totalprice</td>";

                                        if ($foodStatus=="pending") {
                                            echo "<td class=\"text-capitalize alert alert-warning\">$foodStatus</td>
                                                            <td class=\"text-center\">
                                                                <a href=\"foodDelete.php?id=$foodID\" data-toggle=\"popover\" data-placement=\"top\" data-trigger=\"hover\"
                                                                data-content=\"Delete\"><i style=\"color:#7289da;\" class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a></td>";
                                        } elseif ($foodStatus=="delivering") {
                                            echo "<td class=\"text-capitalize alert alert-primary\">$foodStatus</td>
                                                            
                                                            <td></td>";
                                        } elseif ($foodStatus=="completed") {
                                            echo "<td class=\"text-capitalize alert alert-success\">$foodStatus</td>
                                                            
                                                            <td></td>";
                                        }
                                        echo "</tr>";
                                    }
                                    echo "</table><br><br>";
                                }
                                $conn->close();
                            ?>

                    <style>
                        .previous {
                            background-color: #f1f1f1;
                            color: black;
                        }

                        .next {
                            background-color: #7289da;
                            color: white;
                            border-radius: 0.3rem;
                        }

                        main a {
                            text-decoration: none;
                            display: inline-block;
                            padding: 8px 16px;
                        }

                        main a:hover {
                            background-color: #ddd;
                            color: black;
                        }

                        th {
                            background-color: #7289da;
                            color: white;
                            height: 50px;
                        }

                        td {
                            height: 35px
                        }

                        tr:nth-child(even) {
                            background-color: white;
                        }

                        table, th, td {
                            border: 1px solid #7289da;;
                            border-collapse: collapse;
                        }
                    </style>
                    <!-- submission button when finalized the registration -->
                    <div style="text-align: center;">
                        <!-- <a href="" class="previous">&laquo; Previous</a> -->
                        <a href="foodMenu.php" class="next">Order Food</a>
                    </div>
                </div>
                <!-- end of container -->
            </div>
            <!-- end div jumbotron -->
        </main>

        <!-- end div wrapper -->
        <script type="text/javascript">
            // function to delete the activity that want to cancel
            function deleterow(r) {
                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("myTable").deleteRow(i);
            }

        </script>
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
    </body>

</html>