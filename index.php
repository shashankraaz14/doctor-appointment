<?php
include_once 'assets/conn/dbconnect.php';
// include_once 'assets/conn/server.php';
?>


<!-- login -->
<!-- check session -->
<?php
session_start();
// session_destroy();
if (isset($_SESSION['patientSession']) != "") {
    header("Location: patient/patient.php");
}
if (isset($_POST['login'])) {
    $icPatient = mysqli_real_escape_string($con, $_POST['icPatient']);
    $password  = mysqli_real_escape_string($con, $_POST['password']);

    $res = mysqli_query($con, "SELECT * FROM patient WHERE icPatient = '$icPatient'");
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    if ($row['password'] == $password) {
        $_SESSION['patientSession'] = $row['icPatient'];
?>
        <script type="text/javascript">
            alert('Login Success');
        </script>
    <?php
        header("Location: patient/patient.php");
    } else {
    ?>
        <script>
            alert('wrong input ');
        </script>
<?php
    }
}
?>
<!-- register -->
<?php
if (isset($_POST['signup'])) {
    $patientFirstName = mysqli_real_escape_string($con, $_POST['patientFirstName']);
    $patientLastName  = mysqli_real_escape_string($con, $_POST['patientLastName']);
    $patientEmail     = mysqli_real_escape_string($con, $_POST['patientEmail']);
    $icPatient     = mysqli_real_escape_string($con, $_POST['icPatient']);
    $password         = mysqli_real_escape_string($con, $_POST['password']);
    $month            = mysqli_real_escape_string($con, $_POST['month']);
    $day              = mysqli_real_escape_string($con, $_POST['day']);
    $year             = mysqli_real_escape_string($con, $_POST['year']);
    $patientDOB       = $year . "-" . $month . "-" . $day;
    $patientGender = mysqli_real_escape_string($con, $_POST['patientGender']);
    //INSERT
    $query = " INSERT INTO patient (  icPatient, password, patientFirstName, patientLastName,  patientDOB, patientGender,   patientEmail )
VALUES ( '$icPatient', '$password', '$patientFirstName', '$patientLastName', '$patientDOB', '$patientGender', '$patientEmail' ) ";
    $result = mysqli_query($con, $query);
    // echo $result;
    if ($result) {
?>
        <script type="text/javascript">
            alert('Register success. Please Login to make an appointment.');
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert('User already registered. Please try again');
        </script>
<?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Clinic Appointment Application</title>
    <!-- Bootstrap -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style1.css" rel="stylesheet">
    <link href="assets/css/blocks.css" rel="stylesheet">
    <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
    <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&family=Ubuntu&display=swap" rel="stylesheet">
    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link href="assets/css/material.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>

<body>
    <!-- navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img alt="Brand" src="assets/img/logo.png" height="40px"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">


                    <!-- <li><a href="adminlogin.php">Admin</a></li> -->
                    <li><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>

                    <li>
                        <p class="navbar-text">Already have an account?</p>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">

                                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <label class="sr-only" for="icPatient">Email</label>
                                                <input type="text" class="form-control" name="icPatient" placeholder="IC Number" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Sign in</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navigation -->

    <!-- modal container start -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- modal content -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Sign Up</h3>
                </div>
                <!-- modal body start -->
                <div class="modal-body">

                    <!-- form start -->
                    <div class="container" id="wrap">
                        <div class="row">
                            <div class="col-md-6">

                                <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                    <h4>It's free and always will be.</h4>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6">
                                            <input type="text" name="patientFirstName" value="" class="form-control input-lg" placeholder="First Name" required />
                                        </div>
                                        <div class="col-xs-6 col-md-6">
                                            <input type="text" name="patientLastName" value="" class="form-control input-lg" placeholder="Last Name" required />
                                        </div>
                                    </div>

                                    <input type="text" name="patientEmail" value="" class="form-control input-lg" placeholder="Your Email" required />
                                    <input type="number" name="icPatient" value="" class="form-control input-lg" placeholder="Your IC Number" required />


                                    <input type="password" name="password" value="" class="form-control input-lg" placeholder="Password" required />

                                    <input type="password" name="confirm_password" value="" class="form-control input-lg" placeholder="Confirm Password" required />
                                    <label>Birth Date</label>
                                    <div class="row">

                                        <div class="col-xs-4 col-md-4">
                                            <select name="month" class="form-control input-lg" required>
                                                <option value="">Month</option>
                                                <option value="01">Jan</option>
                                                <option value="02">Feb</option>
                                                <option value="03">Mar</option>
                                                <option value="04">Apr</option>
                                                <option value="05">May</option>
                                                <option value="06">Jun</option>
                                                <option value="07">Jul</option>
                                                <option value="08">Aug</option>
                                                <option value="09">Sep</option>
                                                <option value="10">Oct</option>
                                                <option value="11">Nov</option>
                                                <option value="12">Dec</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <select name="day" class="form-control input-lg" required>
                                                <option value="">Day</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-4 col-md-4">
                                            <select name="year" class="form-control input-lg" required>
                                                <option value="">Year</option>

                                                <option value="1981">1981</option>
                                                <option value="1982">1982</option>
                                                <option value="1983">1983</option>
                                                <option value="1984">1984</option>
                                                <option value="1985">1985</option>
                                                <option value="1986">1986</option>
                                                <option value="1987">1987</option>
                                                <option value="1988">1988</option>
                                                <option value="1989">1989</option>
                                                <option value="1990">1990</option>
                                                <option value="1991">1991</option>
                                                <option value="1992">1992</option>
                                                <option value="1993">1993</option>
                                                <option value="1994">1994</option>
                                                <option value="1995">1995</option>
                                                <option value="1996">1996</option>
                                                <option value="1997">1997</option>
                                                <option value="1998">1998</option>
                                                <option value="1999">1999</option>
                                                <option value="2000">2000</option>
                                                <option value="2001">2001</option>
                                                <option value="2002">2002</option>
                                                <option value="2003">2003</option>
                                                <option value="2004">2004</option>
                                                <option value="2005">2005</option>
                                                <option value="2006">2006</option>
                                                <option value="2007">2007</option>
                                                <option value="2008">2008</option>
                                                <option value="2009">2009</option>
                                                <option value="2010">2010</option>
                                                <option value="2011">2011</option>
                                                <option value="2012">2012</option>
                                                <option value="2013">2013</option>
                                            </select>
                                        </div>
                                    </div>
                                    <label>Gender : </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="patientGender" value="male" required />Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="patientGender" value="female" required />Female
                                    </label>
                                    <br />
                                    <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>

                                    <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="signup" id="signup">Create my account</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <!-- modal container end -->

    <!-- 1st section start -->
    <section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 style="font-family:'Trebuchet MS';">Make <span style="font-family:Ubuntu; color:red">Appointment</span> Today!</h2>
                    <p>This is Doctor's Schedule. Please <span class="label label-success">Login</span> to make an appointment. </p>

                    <!-- date textbox -->

                    <div class="input-group" style="margin-bottom:10px;">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </div>
                        <input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d") ?>" onchange="showUser(this.value)" />
                    </div>

                    <!-- date textbox end -->

                    <!-- script start -->
                    <script>
                        function showUser(str) {

                            if (str == "") {
                                document.getElementById("txtHint").innerHTML = "";
                                return;
                            } else {
                                if (window.XMLHttpRequest) {
                                    // code for IE7+, Firefox, Chrome, Opera, Safari
                                    xmlhttp = new XMLHttpRequest();
                                } else {
                                    // code for IE6, IE5
                                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                }
                                xmlhttp.onreadystatechange = function() {
                                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                                    }
                                };
                                xmlhttp.open("GET", "getuser.php?q=" + str, true);
                                console.log(str);
                                xmlhttp.send();
                            }
                        }
                    </script>

                    <!-- script start end -->

                    <!-- table appointment start -->
                    <div id="txtHint"><b> </b></div>

                    <!-- table appointment end -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- first section end -->

    <!-- second section start -->
    <div class="container">
        <div class="underlined-title">
            <h3 style="font-family:Ubuntu;">Get in <span class="label label-danger">Touch</span> </h3>
            <hr>
            <h2>PRECAUTIONS TO BE TAKEN</h2>
        </div>
        <div class="row" style="font-family:Ubuntu;">
            <div class="col s12 m6 l4">
                <div class="card  red darken-2" style="border-radius:15px 50px;">
                    <div class="card-content yellow-text">
                        <span class="card-title"><i class="fas fa-people-arrows"></i> Stay 6 Feet Away</span>
                        <p class="white-text">If possible, maintain 6 feet between the person who is sick and other household members.
                            Remember that some people without symptoms may be able to spread virus.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card  teal darken-4" style="border-radius:50px 15px;">
                    <div class="card-content white-text">
                        <span class="card-title"><i class="fas fa-head-side-mask"></i> Wear a Mask</span>
                        <p class="pink-text">Everyone 2 years and older should wear masks in public.
                            Wear your mask over your nose and mouth and secure it under your chin.
                            Make sure you can breathe easily.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card purple darken-4" style="border-radius:15px 50px;">
                    <div class="card-content white-text">
                        <span class="card-title"><i class="fas fa-band-aid"></i> Get Vaccinated</span>
                        <p class="green-text">Authorized COVID-19 vaccines can help protect you from COVID-19.
                            You should get a COVID-19 vaccine when it is available to you. COVID-19 vaccines are safe and effective.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="font-family:'Ubuntu', sans-serif;">
            <div class="col s12 m6 l4">
                <div class="card grey darken-3" style="border-radius:50px 15px;">
                    <div class="card-content white-text">
                        <span class="card-title"><i class="fas fa-users-slash"></i> Avoid Crowds & Poorly Ventilated</span>
                        <p class="yellow-text">Being in crowds like in restaurants, bars, fitness centers,
                            or movie theaters puts you at higher risk for COVID-19.
                        </p>
                    </div>
                </div>
            </div>
            <div class=" col s12 m6 l4">
                <div class="card light-green darken-1" style="border-radius:15px 50px;">
                    <div class="card-content white-text">
                        <span class="card-title"><i class="fas fa-hands-wash"></i> Wash Your Hands Often</span>
                        <p class="black-text">Wash your hands often with soap and water for at least 20 seconds
                            especially after you have been in a public place,
                            or after blowing your nose, coughing, or sneezing.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="card blue darken-1" style="border-radius:50px 15px;">
                    <div class="card-content black-text">
                        <span class="card-title"><i class="fas fa-box-tissue"></i> Cover Coughs & Sneezes</span>
                        <p class="yellow-text">If you are wearing a mask: You can???cough or sneeze into your mask.
                            Put on a new, clean mask as soon as possible and wash your hands.Immediately wash your hands with soap and water.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- second section end -->
    <!-- footer start -->
    <div class="copyright-bar bg-black">
        <div class="container">
            <p class="pull-left small">?? <a href="#">Dr Sinha</a></p>
            <p class="pull-right small"><a href="adminlogin.php">Admin</a></p>
        </div>
    </div>
    <!-- footer end -->
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').focus()
        })
    </script>
    <!-- date start -->

    <script>
        $(document).ready(function() {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'yyyy-mm-dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })

        })
    </script>

    <!-- date end -->

</body>

</html>