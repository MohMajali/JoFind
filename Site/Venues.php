<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];

$category_id = $_GET['category_id'];
$city_id = $_GET['city_id'];
$filter = $_GET['pop_id'];

$venues = [];

if (isset($_POST['Submit'])) {

    $venue = '%' . $_POST['venue'] . '%';

    $query = mysqli_query($con, "SELECT * from places WHERE active = 1 AND status_id = 2 AND name LIKE '$venue'");

    while ($row1 = mysqli_fetch_array($query)) {

        $place_id = $row1['id'];
        $place_name = $row1['name'];
        $place_image = $row1['image'];

        $sql3 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id' AND active = 1");
        $row3 = mysqli_fetch_array($sql3);

        $category_name = $row3['name'];

        $venues[] = [
            "place_id" => $place_id,
            "place_name" => $place_name,
            "place_image" => $place_image,
            "category_name" => $category_name,
        ];

    }

} else if (isset($category_id)) {

    $cookies = $con->prepare("INSERT INTO customer_logs (customer_id, category_id) VALUES (?, ?) ");
    $cookies->bind_param("ii", $C_ID, $category_id);
    $cookies->execute();

    $query = mysqli_query($con, "SELECT * from places WHERE active = 1 AND status_id = 2 AND category_id = '$category_id'");

    while ($row1 = mysqli_fetch_array($query)) {

        $place_id = $row1['id'];
        $place_name = $row1['name'];
        $place_image = $row1['image'];

        $sql3 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id' AND active = 1");
        $row3 = mysqli_fetch_array($sql3);

        $category_name = $row3['name'];

        $venues[] = [
            "place_id" => $place_id,
            "place_name" => $place_name,
            "place_image" => $place_image,
            "category_name" => $category_name,
        ];

    }

} else if (isset($city_id)) {

    $query = mysqli_query($con, "SELECT * from places WHERE active = 1 AND status_id = 2 AND city_id = '$city_id'");

    while ($row1 = mysqli_fetch_array($query)) {

        $place_id = $row1['id'];
        $place_name = $row1['name'];
        $place_image = $row1['image'];
        $category_id = $row1['category_id'];

        $sql3 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id' AND active = 1");
        $row3 = mysqli_fetch_array($sql3);

        $category_name = $row3['name'];

        $venues[] = [
            "place_id" => $place_id,
            "place_name" => $place_name,
            "place_image" => $place_image,
            "category_name" => $category_name,
        ];

    }

} else if ($filter == 'popularity') {

    $query = mysqli_query($con, "SELECT * from tops ORDER BY id DESC");

    while ($row1 = mysqli_fetch_array($query)) {

        $place_id = $row1['place_id'];

        $sql2 = mysqli_query($con, "SELECT * from places WHERE id = '$place_id' AND active = 1 AND status_id = 2");
        $row2 = mysqli_fetch_array($sql2);

        $place_name = $row2['name'];
        $place_image = $row2['image'];
        $category_id = $row2['category_id'];

        $sql3 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id' AND active = 1");
        $row3 = mysqli_fetch_array($sql3);

        $category_name = $row3['name'];

        $venues[] = [
            "place_id" => $place_id,
            "place_name" => $place_name,
            "place_image" => $place_image,
            "category_name" => $category_name,
        ];
    }

} else if ($filter == 'best_rating') {

    $query = mysqli_query($con, "SELECT * from places WHERE active = 1 AND status_id = 2 AND total_rate >= 4.5");

    while ($row1 = mysqli_fetch_array($query)) {

        $place_id = $row1['id'];
        $place_name = $row1['name'];
        $place_image = $row1['image'];
        $category_id = $row1['category_id'];

        $sql3 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id' AND active = 1");
        $row3 = mysqli_fetch_array($sql3);

        $category_name = $row3['name'];

        $venues[] = [
            "place_id" => $place_id,
            "place_name" => $place_name,
            "place_image" => $place_image,
            "category_name" => $category_name,
        ];

    }
} else {

    $query = mysqli_query($con, "SELECT * from places WHERE active = 1 AND status_id = 2");

    while ($row1 = mysqli_fetch_array($query)) {

        $place_id = $row1['id'];
        $place_name = $row1['name'];
        $place_image = $row1['image'];
        $category_id = $row1['category_id'];

        $sql3 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id' AND active = 1");
        $row3 = mysqli_fetch_array($sql3);

        $category_name = $row3['name'];

        $venues[] = [
            "place_id" => $place_id,
            "place_name" => $place_name,
            "place_image" => $place_image,
            "category_name" => $category_name,
        ];

    }

}

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
            <a href="./index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">JO</span>Find</h1>
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
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">JO</span>Find</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                        <a href="index.php" class="nav-item nav-link ">Home</a>
                            <a href="Venues.php" class="nav-item nav-link active">Venues</a>
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
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">All Venues</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Venues</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <!-- <div class="col-lg-3 col-md-12">
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">$200 - $300</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">$300 - $400</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">$400 - $500</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>

                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>

                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
            </div> -->
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="" class="col-12 row">


                                <div class="input-group col-4">
                                    <select class="custom-select" name="category_id" id="">

<option value="" disabled selected>Select Category</option>
                                    <?php
$sql122211 = mysqli_query($con, "SELECT * from categories WHERE active = 1 ORDER BY id DESC");
while ($row12222111 = mysqli_fetch_array($sql122211)) {

    $category_id_sql = $row12222111['id'];
    $category_name_sql = $row12222111['name'];

    ?>

            <option value="<?php echo $category_id_sql ?>"><?php echo $category_name_sql ?></option>
<?php
}?>

                                    </select>
                                </div>




                                <div class="input-group col-4">
                                    <select class="custom-select" name="city_id" id="">


                                    <option value="" disabled selected>Select City</option>
                                    <?php
$sql212121 = mysqli_query($con, "SELECT * from cities ORDER BY id DESC");
while ($row212121 = mysqli_fetch_array($sql212121)) {

    $city_id_sql = $row212121['id'];
    $city_name_sql = $row212121['city'];

    ?>

            <option value="<?php echo $city_id_sql ?>"><?php echo $city_name_sql ?></option>
<?php
}?>

                                    </select>
                                </div>





                                <div class="input-group col-4">
                                    <select class="custom-select" name="pop_id" id="">



                                    <option value="" disabled selected>Select </option>

            <option value="popularity">Popularity</option>
            <option value="best_rating">Best Rating</option>
            <option value="All">All</option>


                                    </select>
                                </div>


                                <div class="d-flex align-items-center justify-content-center mt-3 col-12">
    <button type="submit" class="btn btn-primary">Filter</button>
</div>




                            </form>
                        </div>
                    </div>



                    <?php

foreach ($venues as $venue) {

    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="../Place_Dashboard/<?php echo $venue['place_image'] ?>" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3"><?php echo $venue['place_name'] ?></h6>
                                <div class="d-flex justify-content-center">
                                    <h6><?php echo $venue['category_name'] ?></h6>
                                </div>
                            </div>

                            <?php if ($C_ID) {?>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="Venue.php?venue_id=<?php echo $venue['place_id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                </div>
                                <?php }?>
                        </div>
                    </div>

                    <?php
}?>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


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