<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];
$venue_id = $_GET['venue_id'];

if ($C_ID) {

    $cookies = $con->prepare("INSERT INTO customer_logs (customer_id, place_id) VALUES (?, ?) ");
    $cookies->bind_param("ii", $C_ID, $venue_id);

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    $sql2 = mysqli_query($con, "select * from places where id='$venue_id'");
    $row2 = mysqli_fetch_array($sql2);

    $venue_name = $row2['name'];
    $venue_image = $row2['image'];
    $venue_email = $row2['email'];
    $venue_description = $row2['description'];
    $venue_total_rate = $row2['total_rate'];
    $venue_phone = $row2['phone'];

    $sql3 = mysqli_query($con, "select COUNT(id) AS reviews from feedbacks where place_id='$venue_id'");
    $row3 = mysqli_fetch_array($sql3);

    $venue_feedbacks_counts = $row3['reviews'];

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
        .selected-item {
            border-color: red !important;
        }
    </style>
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
            <?php

if ($C_ID) {?>

<div class="col-lg-3 col-6 text-right">
<a href="" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>
             <?php }?>
        </div>
    </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">


                    <?php
$sql1 = mysqli_query($con, "SELECT * from categories WHERE active = 1 ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $category_id = $row1['id'];
    $category_name = $row1['name'];
    $category_image = $row1['image'];

    ?>

                        <div class="nav-item dropdown">
                            <a href="Venues.php?category_id=<?php echo $category_id ?>" class="nav-link category-link" data-category-id="<?php echo $category_id ?>" data-toggle="dropdown"><?php echo $category_name ?> <i class="fa fa-angle-down float-right mt-1"></i></a>


                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">

                            </div>


                        </div>

                        <?php
}?>





                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3"><?php echo $venue_name ?> Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><?php echo $venue_name ?> Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">

                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="../Place_Dashboard/<?php echo $venue_image ?>" alt="Image">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold"><?php echo $venue_name ?></h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">

                    <?php for ($i = 1; $i <= $venue_total_rate; $i++) {?>

                        <small class="fas fa-star"></small>

                        <?php }?>

                    </div>
                    <small class="pt-1">(<?php echo $venue_feedbacks_counts ?> Reviews)</small>
                </div>
                <p class="mb-4"><?php echo $venue_description ?></p>

                <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Play A Game To Get Offer</span></h2>
        </div>

        <div class="text-center mb-4">
        <a href="./Prize_wheel.php?venue_id=<?php echo $venue_id ?>" class="btn btn-primary">Play Game</a>
        </div>

    </div>

            </div>
        </div>







        <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Booking Options</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="">

                <?php
$sql1 = mysqli_query($con, "SELECT * from booking_options WHERE active = 1 AND place_id = '$venue_id' ORDER BY id DESC");

$counter = 0;

while ($row1 = mysqli_fetch_array($sql1)) {

    $option_id = $row1['id'];
    $title = $row1['title'];
    $date_time = $row1['date_time'];
    $quantity = $row1['quantity'];
    $has_soft_drinks = $row1['has_soft_drinks'];
    $has_food = $row1['has_food'];
    $price = $row1['price'];

    $counter += 1;
    ?>
                    <div onclick="onDivClick(event)" id="option-<?php echo $option_id ?>-<?php echo $venue_id ?>" class="col-lg-3 col-md-6 col-sm-12 pb-1 border p-4">
                        <h4 class="text-center">Option <?php echo $counter ?> : <?php echo $title ?></h4>
                        <h5 class="text-center">Date&Time : <?php echo $date_time ?></h5>
                        <h5 class="text-center">People : <?php echo $quantity ?></h5>
                        <h6 class="text-center">Soft Drink : <?php echo $has_soft_drinks == 1 ? 'Served' : 'Not Served' ?></h6>
                        <h6 class="text-center">Food : <?php echo $has_food == 1 ? 'Served' : 'Not Served' ?></h6>
                        <h6 class="text-center"><?php echo $price ?>JODs</h6>
                    </div>
                   <?php
}?>
                </div>
            </div>
        </div>
    </div>



    <?php if ($C_ID) {?>
    <div class="container-fluid py-5 d-none" id="book_now">
        <div class="text-center mb-4">
            <!-- <h2 class="section-title px-5"><span class="px-2">Booking Options</span></h2> -->

            <button onclick="navigate(event)" class="btn btn-primary px-5">Book Now!</a>
        </div>
    </div>
    <?php }?>

        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <!-- <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a> -->
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (<?php echo $venue_feedbacks_counts ?>)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3"><?php echo $venue_name ?> Description</h4>
                        <p><?php echo $venue_description ?></p>
                    </div>
                    <!-- <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Additional Information</h4>
                        <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                  </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item px-0">
                                        Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                    </li>
                                    <li class="list-group-item px-0">
                                        Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                    </li>
                                  </ul>
                            </div>
                        </div>
                    </div> -->
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">

                        <?php
$sql1 = mysqli_query($con, "SELECT * from feedbacks WHERE place_id = '$venue_id' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $customer_id = $row1['customer_id'];
    $message = $row1['message'];
    $created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from users WHERE id = '$customer_id' AND active = 1");
    $row2 = mysqli_fetch_array($sql2);

    $customer_name = $row2['name'];
    $customer_image = $row2['image'];

    ?>

                            <div class="col-md-6">
                                <div class="media mb-4">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMg_4QMb_SkaPs0XXddwSldTXcgQCi2tdk0w&s" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6><?php echo $customer_name ?><small> - <i><?php echo $created_at ?></i></small></h6>
                                        <!-- <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div> -->
                                        <p><?php echo $message ?>.</p>
                                    </div>
                                </div>
                            </div>
                            <?php
}?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">


                <?php
$sql1 = mysqli_query($con, "SELECT * from tops ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $top_id = $row1['id'];
    $place_id = $row1['place_id'];

    $sql2 = mysqli_query($con, "SELECT * from places WHERE id = '$place_id' AND active = 1 AND status_id = 2");
    $row2 = mysqli_fetch_array($sql2);

    $place_name = $row2['name'];
    $place_image = $row2['image'];
    $category_id = $row2['category_id'];

    $sql3 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id' AND active = 1");
    $row3 = mysqli_fetch_array($sql3);

    $category_name = $row3['name'];

    ?>

                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="../Place_Dashboard/<?php echo $place_image ?>" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3"><?php echo $place_name ?></h6>
                            <div class="d-flex justify-content-center">
                                <h6><?php echo $category_name ?></h6><h6 class="text-muted ml-2"></h6>
                            </div>
                        </div>
                        
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="./Venue.php?venue_id=<?php echo $place_id ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        </div>
                    </div>


                    <?php
}?>

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->


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
