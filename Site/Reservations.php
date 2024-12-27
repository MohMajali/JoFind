<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

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

    <style>

.star {
  color: #ccc; /* Default color for stars */
}

.star:hover ~ .star {
  color: #fad00e; /* Change color of stars when hovered */
}

.star:hover {
  color: #fad00e; /* Change color of hovered star */
}


    </style>
</head>

<body style="background-color: #051F20 !important;">
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
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
                                <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Account</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="Reservations.php" class="dropdown-item">Reservations</a>
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
                            <a href="../Login.php" class="nav-item nav-link">Login</a>
                            <a href="../Register.php" class="nav-item nav-link">Register</a>
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
            <h1 style="color: #DAC1B1 !important;" class="font-weight-semi-bold text-uppercase mb-3">Reservations</h1>
            <div class="d-inline-flex">
                <p style="color: #DAC1B1 !important;" class="m-0"><a style="color: #DAC1B1 !important;" href="./index.php">Home</a></p>
                <p style="color: #DAC1B1 !important;" class="m-0 px-2">-</p>
                <p style="color: #DAC1B1 !important;" class="m-0">Reservations</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Venue Name</th>
                            <th>Date Time</th>
                            <th>Offer</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Rate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                    <?php
$sql1 = mysqli_query($con, "SELECT * from reservations WHERE customer_id = '$C_ID' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $reservation_id = $row1['id'];
    $place_id = $row1['place_id'];
    $customer_id = $row1['customer_id'];
    $status_id = $row1['status_id'];
    $offer_id = $row1['offer_id'];
    $date_time = $row1['date_time'];
    $price = $row1['price'];
    $total_price = $row1['total_price'];
    $created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from places WHERE id = '$place_id'");
    $row2 = mysqli_fetch_array($sql2);

    $venue_name = $row2['name'];

    $sql4 = mysqli_query($con, "SELECT * from statuses WHERE id = '$status_id'");
    $row4 = mysqli_fetch_array($sql4);

    $status = $row4['name'];

    $sql5 = mysqli_query($con, "SELECT * from offers WHERE id = '$offer_id'");
    $row5 = mysqli_fetch_array($sql5);

    $offer = $row5['offer'];

    ?>


                        <tr>
                            <td style="color: #DAC1B1 !important;" class="align-middle"> <?php echo $venue_name ?></td>
                            <td style="color: #DAC1B1 !important;" class="align-middle"><?php echo $date_time ?></td>
                            <td style="color: #DAC1B1 !important;" class="align-middle"><?php echo ($offer ?? '-') ?></td>
                            <td style="color: #DAC1B1 !important;" class="align-middle"><?php echo $price ?> JODs</td>
                            <td style="color: #DAC1B1 !important;" class="align-middle"><?php echo $total_price ?> JODs</td>
                            <td style="color: #DAC1B1 !important;" class="align-middle"><?php echo $status ?></td>
                            <td style="color: #DAC1B1 !important;" class="align-middle" dir="rtl">

<a href="Rate_Venue.php?Rate=5&place_id=<?php echo $place_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="5" class="fa fa-star"></i></a>

<a href="Rate_Venue.php?Rate=4&place_id=<?php echo $place_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="4" class="fa fa-star"></i></a>

<a href="Rate_Venue.php?Rate=3&place_id=<?php echo $place_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="3" class="fa fa-star"></i></a>

<a href="Rate_Venue.php?Rate=2&place_id=<?php echo $place_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="2" class="fa fa-star"></i></a>

<a href="Rate_Venue.php?Rate=1&place_id=<?php echo $place_id; ?>&C_ID=<?php echo $C_ID; ?>" role="button" class="star"><i title="1" class="fa fa-star"></i></a>

                            </td>
                            <td class="align-middle"><a  style="color: #DAC1B1 !important;" href="./Feedback.php?venue_id=<?php echo $place_id ?>" class="btn btn-sm btn-primary">

                            Add Feedback
                            </a></td>
                        </tr>


                        <?php
}?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Cart End -->


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
</body>

</html>