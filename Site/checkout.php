<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];
$venue_id = $_GET['venue_id'];
$option_id = $_GET['option_id'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    if (isset($_POST['Submit'])) {

        $place_id = $_POST['place_id'];
        $customer_id = $_POST['customer_id'];
        $option_id = $_POST['option_id'];

        $optionSql = mysqli_query($con, "SELECT * FROM booking_options WHERE id = '$option_id'");
        $optionRaw = mysqli_fetch_array($optionSql);

        $date_time = date('Y-m-d H:i:s', strtotime($optionRaw['date_time']));
        $price = $optionRaw['price'];

        $offerWinnerSql = mysqli_query($con, "SELECT * FROM offer_winners WHERE customer_id = '$customer_id' AND is_used = 0");
        $offerWinnerRaw = mysqli_fetch_array($offerWinnerSql);

        $offer_winner_id = $offerWinnerRaw['id'];
        $offer_id = $offerWinnerRaw['offer_id'];

        if ($offer_id) {

            $offerSql = mysqli_query($con, "SELECT * FROM offers WHERE id = '$offer_id'");
            $offerRaw = mysqli_fetch_array($offerSql);

            $discount = $offerRaw['discount'];

            $total_price = $price * $discount;

        } else {
            $total_price = $price;
        }

        $stmt = $con->prepare("INSERT INTO reservations (place_id, customer_id, offer_id, date_time, price, total_price) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("iiisdd", $place_id, $customer_id, $offer_id, $date_time, $price, $total_price);

        if ($stmt->execute()) {

            $is_used = true;

            $stmt = $con->prepare("UPDATE offer_winners SET is_used = ? WHERE id = ?");

            $stmt->bind_param("ii", $is_used, $offer_winner_id);

            if ($stmt->execute()) {

                echo "<script language='JavaScript'>
                  alert ('Reservation Has Been Added Booked !');
             </script>";

                echo "<script language='JavaScript'>
            document.location='./Reservations.php';
               </script>";

            }
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

<body>
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
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">JO</span>Find</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="./Venues.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="venue" class="form-control" placeholder="Search for Venues">
                        <div class="input-group-append">
                            <button type="Submit" class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
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
                            <a href="Venues.php" class="nav-item nav-link active">Venues</a>
                            <a href="contact.php" class="nav-item nav-link ">Contact</a>
                            <?php

if ($C_ID) {?>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Account</a>
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
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Checkout</h4>
                    <form method="POST" accept="checkout.php?venue_id=<?php echo $venue_id ?>&option_id=<?php echo $option_id ?>" class="row">

                        <input type="hidden" name="place_id" value="<?php echo $venue_id ?>">
                        <input type="hidden" name="customer_id" value="<?php echo $C_ID ?>">
                        <input type="hidden" name="option_id" value="<?php echo $option_id ?>">




                        <div class="col-md-12 form-group">
                            <label>Name On Card</label>
                            <input class="form-control" type="text" placeholder="Jhon-doe" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Card Number</label>
                            <input class="form-control" type="text" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>CVV</label>
                            <input class="form-control" type="text" placeholder="XXX" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Expiry Date</label>
                            <input class="form-control" type="month" placeholder="MM/YYYY" required>
                        </div>


                        <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" name="Submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Book Now</button>
                    </div>
                    </form>
                </div>

            </div>



        </div>
    </div>
    <!-- Checkout End -->


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