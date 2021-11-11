<!DOCTYPE html>
<html>

<?php

session_start();
if (!isset($_SESSION['logged_in'])) {
    session_destroy();
    header('location: nologin.php');
}
include_once("config.php");
$user_email = $_SESSION['user_email'];
?>

<head>
    <meta charset="utf-8">
    <!-- To make the site responsive when user resize the browser -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS source file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/manage.css">
    <link rel="stylesheet" href="../css/login.css">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">


    <!-- Custom css to override any class in bootstrap.css -->

    <title>Manage Account</title>
    <style>
        input[type=text],
        input[type=password],
        input[type=email] {
            padding-left: 15px;
        }
    </style>
</head>
<?php
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
        $disabilityDetail = $res["disabilityStatus"];
        $roomNo = $res["roomNo"];
        $password = $res["password"];
        $profilepicPath = $res["profilepicPath"];
    }
}

?>

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
                            <a class="nav-link" href="accoApply.php">Accommodations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="report.php">Report</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?php echo $profilepicPath ?>" width="30" height="30" class="rounded-circle" style="object-fit:cover;">
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
            <h1 class="display-4">Update your details</h1>
            <p class="lead">Please make sure the information that you have entered is correct and valid.
            </p>
        </div>
    </header>


    <div class="container-sm">

        <img src="<?php echo $profilepicPath; ?>" class="rounded" width="100" height="110" style="object-fit:cover;" alt="no-pic">

        <br>
        <br>
        <form method="POST" action="upload.php" enctype="multipart/form-data">

            <div style="width: 100%;">
                <input type="file" name="file" id="image" onchange="Filevalidation()">
                <br />
                <br />
                <input type="submit" name="submit" id="insert" value="Change picture" onchange="Filevalidation()" class="btn btn-primary waves-effect">
            </div>
        </form>
    </div>

    <form method="POST" action="updateProcess.php">
        <div class="container-sm shadow-sm text-left">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $name; ?>">
                <span id='namemessage'></span>
            </div>

            <div class="form-group">
                <label for="ic_num">I/C No.</label>
                <input type="text" name="ic_num" class="form-control" id="ic_num" value="<?php echo $icNum; ?>">
                <span id='icmessage'></span>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender">
                    <?php
                    echo "<option>" . $gender . "</option>";
                    ?>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="race">Race</label>
                <select class="form-control" name="race">
                    <?php
                    echo "<option>" . $race . "</option>";
                    ?>
                    <option>Malay</option>
                    <option>Chinese</option>
                    <option>Indian</option>
                    <option>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date of Birth</label>
                <br>
                <input type="date" name="birthdate" class="form-control" value="<?php echo $birthdate; ?>">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" value="<?php echo $address; ?>">
                <span id='addressmessage'></span>
            </div>

            <div class="form-group">
                <label for="levelStudy">Level of Study</label>
                <select class="form-control" id="levelStudy" name="levelStudy" placeholder="Choose one">
                    <?php
                    echo "<option>" . $levelStudy . "</option>";
                    ?>
                    <option>Undergraduate</option>
                    <option>Postgraduate</option>
                </select>
            </div>

            <div class="form-group">
                <label for="faculty">Faculty</label>
                <select class="form-control" id="faculty" name="faculty" placeholder="Choose one">
                    <?php
                    echo "<option>" . $faculty . "</option>";
                    ?>
                    <option>Faculty of Law</option>
                    <option>Faculty of Engineering</option>
                    <option>Faculty of Medicine</option>
                    <option>Faculty of Built Environment</option>
                    <option>Faculty of Science</option>
                    <option>Faculty of Language and Linguistics</option>
                    <option>Academy of Islamic Studies</option>
                    <option>Faculty of Computer Science and Information Technology</option>
                    <option>Academy of Malay Studies</option>
                </select>
            </div>

            <div class="form-group" id="semua">
                <label for="programme">Programme</label>
                <select class="form-control" name="programme" id="programmeall" placeholder="Choose one">
                    <?php
                    echo "<option selected='selected'>" . $programme . "</option>";
                    ?>
                    <option class="law">Bachelor of Law</option>
                    <option class="law">Bachelor of Jurisprudence</option>
                    <option class="law">Master of Laws</option>
                    <option class="law">Master of Criminal Justice</option>
                    <option class="law">Master of Commercial Justice</option>
                    <option class="law">Master of Legal Studies</option>
                    <option class="engineering">Bachelor of Biomedical Engineering</option>
                    <option class="engineering">Bachelor of Chemical Engineering</option>
                    <option class="engineering">Bachelor of Civil Engineering</option>
                    <option class="engineering">Bachelor of Electrical Engineering</option>
                    <option class="engineering">Bachelor of Mechanical Engineering</option>
                    <option class="engineering">Master of Biomedical Engineering</option>
                    <option class="engineering">Master of Safety, Health and Environment Engineering</option>
                    <option class="engineering">Master of Industrial Electronics Engineering</option>
                    <option class="engineering">Master of Telecommunication Engineering</option>
                    <option class="engineering">Master of Mechanical Engineering</option>
                    <option class="engineering">Master of Engineering Science></option>
                    <option class="engineering">Doctor of Philosophy</option>
                    <option class="medicine">Bachelor of Medicine</option>
                    <option class="medicine">Bachelor of Surgery</option>
                    <option class="medicine">Bachelor of Biomedical Science</option>
                    <option class="medicine">Bachelor of Nursing Science</option>
                    <option class="medicine">Master of Anaesthesiology [MAnaes]</option>
                    <option class="medicine">Master of Ophthalmology [MOphthal]]</option>
                    <option class="medicine">Master of Paediatrics [MPaeds]</option>
                    <option class="medicine">Master of Neurosurgery</option>
                    <option class="medicine">Master of Medical Education</option>
                    <option class="medicine">Master of Nursing Science [MNSc]</option>
                    <option class="medicine">Doctor of Public Health [DrPH]</option>
                    <option class="medicine">Doctor of Medicine [MD]</option>
                    <option class="built">Bachelor of Science Architecture</option>
                    <option class="built">Bachelor of Quantity Surveying</option>
                    <option class="built">Bachelor of Building Surveying</option>
                    <option class="built">Bachelor of Real Estate</option>
                    <option class="built">Bachelor of Urban & Regional Planning</option>
                    <option class="built">Master of Project Management</option>
                    <option class="built">Master of Real Estate</option>
                    <option class="built">Master of Architecture</option>
                    <option class="built">Master of Facilities and Maintenance Management</option>
                    <option class="built">Master of Architecture</option>
                    <option class="built">Master of Built Environment</option>
                    <option class="built">Doctor of Philosophy</option>
                    <option class="science">Bachelor of Actuarial Science</option>
                    <option class="science">Bachelor of Science in Applied Chemistry</option>
                    <option class="science">Bachelor of Science in Applied Geology</option>
                    <option class="science">Bachelor of Science in Biochemistry</option>
                    <option class="science">Bachelor of Science in Applied Mathematics</option>
                    <option class="science">Bachelor of Science in Chemistry</option>
                    <option class="science">Bachelor of Science in Biotechnology</option>
                    <option class="science">Bachelor of Science in Bioinformatics</option>
                    <option class="science">Bachelor of Science in Biohealth Science</option>
                    <option class="science">Bachelor of Science in Ecology Biodiversity</option>
                    <option class="science">Bachelor of Science in Environmental Management</option>
                    <option class="science">Bachelor of Science in Genetics</option>
                    <option class="science">Bachelor of Science in Geology</option>
                    <option class="science">Bachelor of Science (Materials Science)</option>
                    <option class="science">Bachelor of Science in Mathematics</option>
                    <option class="science">Bachelor of Science in Microbiology</option>
                    <option class="science">Bachelor of Science in Physics</option>
                    <option class="science">Bachelor of Science in Science and Technology Studies</option>
                    <option class="science">Bachelor of Science in Statistics</option>
                    <option class="science">Master of Science (MSc)</option>
                    <option class="science">Master of Petroleum Geoscience</option>
                    <option class="science">Master of Sustainability Science</option>
                    <option class="science">Master of Science in Statistics</option>
                    <option class="science">Master of Science in Instrumental Analytical Chemistry</option>
                    <option class="science">Master of Science in Applied Physics</option>
                    <option class="science">Master of Science (Biotechnology)</option>
                    <option class="science">Master of Science (Environmental Management Technology)</option>
                    <option class="science">Master of Bioinformatics</option>
                    <option class="science">Master of Science In Crop Protection</option>
                    <option class="science">Doctor of Philosophy (PH.D)</option>
                    <option class="language">Bachelor of Arabic Language and Linguistics</option>
                    <option class="language">Bachelor of Chinese Language and Linguistics</option>
                    <option class="language">Bachelor of English Language and Linguistics</option>
                    <option class="language">Bachelor of French Language and Linguistics</option>
                    <option class="language">Bachelor of German Language and Linguistics</option>
                    <option class="language">Bachelor of Japanese Language and Linguistics</option>
                    <option class="language">Bachelor of Spanish Language and Linguistics</option>
                    <option class="language">Bachelor of Tamil Language and Linguistics</option>
                    <option class="language">Bachelor of Italian Language and Linguistics</option>
                    <option class="language">Master of Arts (Linguistics)</option>
                    <option class="language">Master of English Language Studies</option>
                    <option class="language">Doctor of Philosophy (PH.D)</option>
                    <option class="islamic">Bachelor of Usuluddin (Aqclassah And Islamic Thought)</option>
                    <option class="islamic">Bachelor of Usuluddin (Al-Quran And Al-Hadith)</option>
                    <option class="islamic">Bachelor of Usuluddin (Da'wah And Human Development)</option>
                    <option class="islamic">Bachelor of Usuluddin (Islamic History and Civilisation)</option>
                    <option class="islamic">Bachelor of Islamic Education (Islamic Studies)</option>
                    <option class="islamic">Bachelor of Islamic Studies and Information Technology</option>
                    <option class="islamic">Bachelor of Islamic Studies and Science</option>
                    <option class="islamic">Bachelor of Mualamat Management</option>
                    <option class="islamic">Bachelor of Shariah (Fiqh And Usul)</option>
                    <option class="islamic">Bachelor of Shariah (Islamic Astronomy)</option>
                    <option class="islamic">Bachelor of Shariah (Islamic Political Science)</option>
                    <option class="islamic">Bachelor of Shariah (Shariah and Economics)</option>
                    <option class="islamic">Bachelor of Shariah and Law</option>
                    <option class="islamic">Bachelor of Islamic Education (Quranic Studies)</option>
                    <option class="islamic">Master of Usuluddin</option>
                    <option class="islamic">Master of Shariah</option>
                    <option class="islamic">Master of Islamic Studies</option>
                    <option class="islamic">Doctor of Philosophy (Ph.D)</option>
                    <option class="computer">Bachelor of Computer Science (Artificial Intelligence)</option>
                    <option class="computer">Bachelor of Computer Science (Computer System and Network)</option>
                    <option class="computer">Bachelor of Computer Science (Information Systems)</option>
                    <option class="computer">Bachelor of Computer Science (Software Engineering)</option>
                    <option class="computer">Bachelor of Computer Science (Data Science)</option>
                    <option class="computer">Bachelor of Information Technology (Multimedia)</option>
                    <option class="computer">Master of Software Engineering (Software Technology)</option>
                    <option class="computer">Master of Computer Science (Applied Computing)</option>
                    <option class="computer">Master of Data Science</option>
                    <option class="computer">Master of Library and Information Science</option>
                    <option class="computer">Master of Computer Science (Research)</option>
                    <option class="computer">Master of Information Science (Research)</option>
                    <option class="computer">Doctor of Philosophy (Ph.D)</option>
                    <option class="malay">Bachelor of Malay Professionals</option>
                    <option class="malay">Bachelor of Linguistics Malay</option>
                    <option class="malay">Bachelor of Malay Literature</option>
                    <option class="malay">Bachelor of Socio-Cultural</option>
                    <option class="malay">Bachelor of Arts Festival</option>
                    <option class="malay">Master of Malay Studies by Dissertation</option>
                    <option class="malay">Master of Malay Studies by Coursework</option>
                    <option class="malay">Doctor of Philosophy (Ph.D)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="semester">Semester</label>
                <select class="form-control" placeholder="Choose one" name="semester">
                    <?php
                    echo "<option>" . $semester . "</option>";
                    ?>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                </select>
            </div>


            <div class="form-group">
                <label for="disability">Disability</label>
                <select class="form-control" id="disability" placeholder="State your disability" name="disability">
                    <?php
                    echo "<option>" . $disability . "</option>";
                    ?>
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>

            <div class="form-group" id="disabilityDetailDiv">
                <label for="disabilityDetail">Please state your condition details</label>
                <input type="text" class="form-control" id="disabilityDetail" name="disabilityDetail" placeholder="Fill in your condition details" value="<?php echo $disabilityDetail; ?>">
            </div>


            <div class="form-group">
                <label for="room">Room</label>
                <?php
                echo "<input type='text' class='form-control' id='room' name='room' value='$roomNo'>";
                ?>
            </div>
            <br>
            <h3 class="display-5 my-2">Change Password</h3>
            <br>
            <div class="form-group">
                <label for="password">New password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Insert new password">
            </div>
            <div class="form-group">
                <label for="password">Verify new password</label>
                <input type="password" name="rpassword" id="rpassword" class="form-control" placeholder="Insert again the new password">
                <span id='message'></span>
            </div>

            <br>
            <div class="text-center">
                <input type="submit" class="btn btn-primary waves-effect" id="updateButton" name="update" value="Update" required>
            </div>


        </div>
    </form>

    <br>
    <!-- Bootstrap JS source file link -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>



    <script>
        //checking password and verify password is same or not
        var passwordokay = true;
        $('#password, #rpassword').on('keyup', function() {
            if ($('#password').val() != "") {
                $('#rpassword').attr('required', '');
                if ($('#rpassword').val() != "") {
                    if ($('#password').val() == $('#rpassword').val()) {
                        $('#message').html('Matching').css('color', 'green');
                        passwordokay = true;
                        updateAllowed();
                    } else {
                        $('#message').html('Not Matching').css('color', 'red');
                        passwordokay = false;
                        updateAllowed();
                    }
                } else if ($('#password').val() == "" || $('#rpassword').val() == "") {
                    $('#message').html('');
                        passwordokay = true;
                        updateAllowed();
                }

            } else {
                passwordokay = true;
                updateAllowed();
                $('#rpassword').removeAttr('required');
            }
        });

        //checking whether name contains special characters or numbers
        var nameokay = true;
        $('#name').on('keyup', function() {
            if ($('#name').val() != "") {

                function hasNumber(str) {
                    return /\d/.test(str);
                }

                function hasSpecialCharacters(str) {
                    if(/^[a-zA-Z0-9- ]*$/.test(str)){
                        return false;
                    }else{
                        return true
                    }
                }
                if (hasNumber($('#name').val()) && hasSpecialCharacters($('#name').val())) {
                    $('#namemessage').html('Name contains numbers and special characters.').css('color', 'red');
                    nameokay = false;
                    updateAllowed();
                }else if(hasNumber($('#name').val())){
                    $('#namemessage').html('Name contains numbers.').css('color', 'red');
                    nameokay = false;
                    updateAllowed();
                }else if(hasSpecialCharacters($('#name').val())){
                    $('#namemessage').html('Name contains special characters.').css('color', 'red');
                    nameokay = false;
                    updateAllowed();
                } else {
                    $('#namemessage').html('');
                    nameokay = true;
                    updateAllowed();
                }

            } else {
                $('#namemessage').html('');
                nameokay = true;
                updateAllowed();
            }

        });

        //checking the IC number format
        var icokay = true;
        $('#ic_num').on('keyup', function() {
            if ($('#ic_num').val() != "") {
                function isCorrectFormat(str) {
                    return /^\d{6}\-\d{2}\-\d{4}$/.test(str);
                }
                if (isCorrectFormat($('#ic_num').val())) {
                        $('#icmessage').html('');
                        icokay = true;
                        updateAllowed();
                } else{
                    $('#icmessage').html('Wrong format. Example for correct format: 990405-14-4322').css('color', 'red');
                        icokay = false;
                        updateAllowed();
                }

            } else {
                $('#icmessage').html('');
                icokay = true;
                updateAllowed();
            }
        });


        function updateAllowed() {
            if (passwordokay && nameokay && icokay) {
                document.getElementById("updateButton").disabled = false;
            } else {
                document.getElementById("updateButton").disabled = true;
            }
        };

        //user choose Yes for Disability, another input field showed up
        $("#disability").change(function() {
            if ($(this).val() == "Yes") {
                $('#disabilityDetailDiv').show();
                $('#disabilityDetail').attr('required', '');
                $('#disabilityDetail').attr('data-error', 'This field is required.');
            } else {
                $('#disabilityDetailDiv').hide();
                $('#disabilityDetail').removeAttr('required');

            }
        });
        $("#disability").trigger("change");

        //the programme will display based on the faculty chosen by the user
        $("#faculty").change(function() {
            // $('#programmeall').val("Choose one");
            if ($(this).val() == "Faculty of Law") {
                $('.law').show();
                $('.engineering').hide();
                $('.medicine').hide();
                $('.built').hide();
                $('.science').hide();
                $('.language').hide();
                $('.islamic').hide();
                $('.computer').hide();
                $('.malay').hide();
            } else if ($(this).val() == "Faculty of Engineering") {
                $('.engineering').show();
                $('.law').hide();
                $('.medicine').hide();
                $('.built').hide();
                $('.science').hide();
                $('.language').hide();
                $('.islamic').hide();
                $('.computer').hide();
                $('.malay').hide();
            } else if ($(this).val() == "Faculty of Medicine") {
                $('.medicine').show();
                $('.law').hide();
                $('.engineering').hide();
                $('.built').hide();
                $('.science').hide();
                $('.language').hide();
                $('.islamic').hide();
                $('.computer').hide();
                $('.malay').hide();
            } else if ($(this).val() == "Faculty of Built Environment") {
                $('.built').show();
                $('.law').hide();
                $('.engineering').hide();
                $('.medicine').hide();
                $('.science').hide();
                $('.language').hide();
                $('.islamic').hide();
                $('.computer').hide();
                $('.malay').hide();
            } else if ($(this).val() == "Faculty of Science") {
                $('.science').show();
                $('.law').hide();
                $('.engineering').hide();
                $('.medicine').hide();
                $('.built').hide();
                $('.language').hide();
                $('.islamic').hide();
                $('.computer').hide();
                $('.malay').hide();
            } else if ($(this).val() == "Faculty of Language and Linguistics") {
                $('.language').show();
                $('.law').hide();
                $('.engineering').hide();
                $('.medicine').hide();
                $('.built').hide();
                $('.science').hide();
                $('.islamic').hide();
                $('.computer').hide();
                $('.malay').hide();
            } else if ($(this).val() == "Academy of Islamic Studies") {
                $('.islamic').show();
                $('.law').hide();
                $('.engineering').hide();
                $('.medicine').hide();
                $('.built').hide();
                $('.science').hide();
                $('.language').hide();
                $('.computer').hide();
                $('.malay').hide();
            } else if ($(this).val() == "Faculty of Computer Science and Information Technology") {
                $('.computer').show();
                $('.law').hide();
                $('.engineering').hide();
                $('.medicine').hide();
                $('.built').hide();
                $('.science').hide();
                $('.language').hide();
                $('.islamic').hide();
                $('.malay').hide();
            } else if ($(this).val() == "Academy of Malay Studies") {
                $('.malay').show();
                $('.law').hide();
                $('.engineering').hide();
                $('.medicine').hide();
                $('.built').hide();
                $('.science').hide();
                $('.language').hide();
                $('.islamic').hide();
                $('.computer').hide();
            } else {
                $('.law').hide();
                $('.engineering').hide();
                $('.medicine').hide();
                $('.built').hide();
                $('.science').hide();
                $('.language').hide();
                $('.islamic').hide();
                $('.computer').hide();
                $('.malay').hide();
            }

        });
        $("#faculty").trigger("change");
    </script>
    <script>
        Filevalidation = () => {
            const fi = document.getElementById('image');

            // Check if any file is selected. 
            if (fi.files.length > 0) {
                //checking type of file
                var extension = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    alert('Invalid Image File');
                    $('#image').val('');
                }
                //checking the size of file
                for (const i = 0; i <= fi.files.length - 1; i++) {
                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file. 
                    if (file >= 4096) {
                        alert("File too Big, please select a file less than 4mb");
                        $('#image').val('');

                    } else {
                        document.getElementById('size').innerHTML = '<b>' +
                            file + '</b> KB';
                    }
                }
            }
        }


        $(document).ready(function() {
            $('insert').click(function() {
                var image_name = $('#image').val();
                if (image_name == '') {
                    alert("Please select image");
                    return false;
                } else {
                    var extension = $('#image').val().split('.').pop().toLowerCase();
                    alert(extension);
                    if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        alert('Invalid Image File');
                        $('#image').val('');
                        return false;
                    }
                }
            });
        });
    </script>

    <script>
        //JS for navbar
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