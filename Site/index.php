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

            <?php

if ($C_ID) {?>


             <?php }?>



        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">

            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="./index.php" class="text-decoration-none d-block d-lg-none">
                    <h1 style="color: #DAC1B1 !important;" class="m-0 display-5 font-weight-semi-bold">
                        <span style="color: #DAC1B1 !important;" class="text-primary font-weight-bold border px-3 mr-1">JO</span>
                        <span style="color: #DAC1B1 !important;">Find</span>
                    </h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="Venues.php" class="nav-item nav-link">Venues</a>
                            <a href="contact.php" class="nav-item nav-link">Contact</a>

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







                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                    <?php
$sql1 = mysqli_query($con, "SELECT * from sliders WHERE active = 1 ORDER BY id DESC");
$counter = 0;
while ($row1 = mysqli_fetch_array($sql1)) {

    $slider_id = $row1['id'];
    $slider_image = $row1['image'];

    $counter++;
    ?>
                        <div class="carousel-item <?php echo ($counter == 1 ? 'active' : '') ?>" style="height: 410px;" id="<?php echo $slider_id ?>">
                            <img class="img-fluid" src="../Admin_Dashboard/<?php echo $slider_image ?>" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                    <h4 style="color: #DAC1B1 !important;" class="text-light text-uppercase font-weight-medium mb-3">XXXXX XXXX XXXXX</h4>
                                    <h3 style="color: #DAC1B1 !important;" class="display-4 text-white font-weight-semi-bold mb-4">XXX XXXX XXXX XX</h3>
                                </div>
                            </div>
                        </div>
                 <?php
}?>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">

        <?php
$sql1 = mysqli_query($con, "SELECT * from categories WHERE active = 1 ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $category_id = $row1['id'];
    $category_name = $row1['name'];
    $category_image = $row1['image'];

    ?>

            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;height: 100%;">
                    <a href="Venues.php?category_id=<?php echo $category_id ?>" class="cat-img position-relative overflow-hidden mb-3" style="
    height: 260px;
">
                        <img class="img-fluid" src="../Admin_Dashboard/<?php echo $category_image ?>" style="width: 100%;" height="100px" alt="">
                    </a>
                    <h5 style="color: #DAC1B1 !important;" class="font-weight-semi-bold m-0"><?php echo $category_name ?></h5>
                </div>
            </div>

<?php
}?>
        </div>
    </div>
    <!-- Categories End -->



        <!-- TOPS Start -->
        <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 style="color: #DAC1B1 !important;" class="section-title px-5"><span style="background: none;" class="px-2">Top Venues</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">



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


            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div style="background-color: #051F20 !important;" class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="../Place_Dashboard/<?php echo $place_image ?>" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 style="color: #DAC1B1 !important;" class="text-truncate mb-3"><?php echo $place_name ?></h6>
                        <div  class="d-flex justify-content-center">
                            <h6 style="color: #DAC1B1 !important;"><?php echo $category_name ?></h6>
                        </div>
                    </div>

                    <!-- style="color: #DAC1B1 !important;" -->
                    <?php if ($C_ID) {?>
                        <div style="background-color: #051F20 !important;" class="card-footer d-flex justify-content-between bg-light border">
                            <a style="color: #DAC1B1 !important;" href="Venue.php?venue_id=<?php echo $place_id ?>" class="btn btn-sm text-dark p-0">
                                <i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        </div>
                        <?php }?>
                </div>
            </div>


<?php
}?>

        </div>
    </div>
    <!-- TOPS End -->




        <!-- Advertisements -->
        <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">

                    <?php
$sql1 = mysqli_query($con, "SELECT * from advertisements WHERE active = 1 ORDER BY id DESC");
$advCounter = 0;
while ($row1 = mysqli_fetch_array($sql1)) {

    $adv_id = $row1['id'];
    $adv_image = $row1['image'];

    $advCounter++;
    ?>
                        <div onclick="navigate(event)" class="carousel-item <?php echo ($advCounter == 1 ? 'active' : '') ?> <?php echo 'adv-'.$adv_id ?>" style="height: 410px;" id="<?php echo $adv_id ?>">
                            <img class="img-fluid" src="../Admin_Dashboard/<?php echo $adv_image ?>" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center <?php echo 'adv-'.$adv_id ?>">
                        
                            </div>
                        </div>
                 <?php
}?>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- Advertisements -->


    <!-- NearBy Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 style="color: #DAC1B1 !important;" class="section-title px-5"><span style="background: none;" class="px-2">NearBy Venues</span></h2>
        </div>

        <script>
document.addEventListener("DOMContentLoaded", function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }

    function showPosition(position) {

        let userLatitude = position.coords.latitude;
        let userLongitude = position.coords.longitude;

        $.ajax({
            url: 'Get_NearBy_Venues.php',
            type: 'POST',
            data: {
                latitude: userLatitude,
                longitude: userLongitude
            },
            success: function(response) {

                $('#nearby-places').html(response);
            },
            error: function() {
                console.log("Error retrieving nearby places.");
            }
        });
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }
});
</script>



        <div class="row px-xl-5 pb-3" id="nearby-places">

        </div>
    </div>
    <!-- NearBy End -->















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


    <script>

        const navigate = (e) => {
            
            window.location = `./Adverisement.php?advertisement_id=${e.target.classList[5].split('-')[1]}`
        }
    </script>

</body>

</html>
