<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];
$venue_id = $_GET['venue_id'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];
    $phone = $row1['phone'];

    if (isset($_POST['Submit'])) {

        $customer_id = $_POST['customer_id'];
        $place_id = $_POST['venue_id'];
        $message = $_POST['message'];

        $stmt = $con->prepare("INSERT INTO feedbacks (place_id, customer_id, message) VALUES (?, ?, ?)");

        $stmt->bind_param("iis", $place_id, $customer_id, $message);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
                  alert ('Thank You For Your Feedback !');
             </script>";

            echo "<script language='JavaScript'>
            document.location='./Reservations.php';
               </script>";

        }
    }

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JOFind</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../assets/img/Logo.png" rel="icon" />
    <link href="../assets/img/Logo.png" rel="apple-touch-icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body style="background-color: #051F20 !important;">
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <!-- <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a> -->
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>


                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
      
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
            <a href="./index.php" class="text-decoration-none">
                    <h1 style="color: #DAC1B1 !important;" class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">JO</span>Find</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="./Venues.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="venue" class="form-control" placeholder="Search for Venues">
                        <div class="input-group-append">
                            <button type="Submit" name="Submit" class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">

            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="./index.php" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">JO</span>Find</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                        <a href="index.php" class="nav-item nav-link ">Home</a>
                            <a href="Venues.php" class="nav-item nav-link ">Venues</a>
                            <a href="contact.php" class="nav-item nav-link ">Contact</a>
                            <?php

if ($C_ID) {?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown">Account</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                <a href="Reservations.php" class="dropdown-item">Reservations</a>
                                <a href="Favorties.php" class="dropdown-item">Favorties</a>
                                    <a href="Profile.php" class="dropdown-item">Profile</a>
                                    <a href="Logout.php" class="dropdown-item">Logout</a>
                                </div>
                            </div>

                            <?php }

?>
                        </div>
                        <?php

if (!$C_ID) {?>

<div class="navbar-nav ml-auto py-0">
                            <a href="" class="nav-item nav-link">Login</a>
                            <a href="" class="nav-item nav-link">Register</a>
                        </div>
                       <?php }

?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div style="background-color: #051F20 !important;" class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 style="background-color: #DAC1B1 !important;" class="font-weight-semi-bold text-uppercase mb-3">Feedback</h1>
            <div class="d-inline-flex">
                <p style="background-color: #DAC1B1 !important;" class="m-0"><a style="background-color: #DAC1B1 !important;" href="">Home</a></p>
                <p style="background-color: #DAC1B1 !important;" class="m-0 px-2">-</p>
                <p style="background-color: #DAC1B1 !important;" class="m-0">Feedback</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 style="color: #DAC1B1 !important;" class="section-title px-5"><span style="background: none;" class="px-2">Your Feedback</span></h2>
        </div>
        <div class="row px-xl-12">
            <div class="col-lg-12 mb-5">
                <div class="contact-form">
                    <!-- <div id="success"></div> -->
                    <form method="POST" action="Feedback.php" novalidate="novalidate">

                    <input type="hidden" name="customer_id" value="<?php echo $C_ID ?>">
                    <input type="hidden" name="venue_id" value="<?php echo $venue_id ?>">

                        <div class="control-group">
                            <textarea style="background-color: #DAC1B1 !important;" name="message" class="form-control" id=""></textarea>
                            <p class="help-block text-danger"></p>
                        </div>


                        <div>
                            <button class="btn btn-primary py-2 px-4" name="Submit" type="submit" id="sendMessageButton" style="background-color: #DAC1B1 !important;">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php require './Footer.php'?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


    <script src="./js/drop-down.js"></script>
</body>

</html>