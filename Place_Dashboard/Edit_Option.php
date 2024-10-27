<?php
session_start();

include "../Connect.php";

$P_ID = $_SESSION['P_Log'];
$option_id = $_GET['option_id'];

if (!$P_ID) {

    echo '<script language="JavaScript">
     document.location="../Place_Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from places where id='$P_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    $sql2 = mysqli_query($con, "select * from booking_options where id='$option_id'");
    $row2 = mysqli_fetch_array($sql2);

    $title = $row2['title'];
    $description = $row2['description'];
    $date_time = $row2['date_time'];
    $quantity = $row2['quantity'];
    $has_soft_drinks = $row2['has_soft_drinks'];
    $has_food = $row2['has_food'];
    $price = $row2['price'];

    if (isset($_POST['Submit'])) {

        $option_id = $_POST['option_id'];
        $title = $_POST['title'];
        $date_time = date('Y-m-d', strtotime($_POST['date_time']));
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $has_food = $_POST['has_food'] == 'on' ? true : false;
        $has_soft_drinks = $_POST['has_soft_drinks'] == 'on' ? true : false;

        $stmt = $con->prepare("UPDATE booking_options SET title = ?, date_time = ?, quantity = ?, price = ?, description = ?, has_food = ?, has_soft_drinks = ? WHERE id = ? ");

        $stmt->bind_param("ssidsiii", $title, $date_time, $quantity, $price, $description, $has_food, $has_soft_drinks, $option_id);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
              alert ('Option Updated Has Been Updated Successfully !');
         </script>";

            echo "<script language='JavaScript'>
        document.location='./Booking_Options.php';
           </script>";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Category - JoFind</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../assets/img/Logo.png" rel="icon" />
    <link href="../assets/img/Logo.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="../assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="../assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          <img src="../assets/img/Logo.png" alt="" />

        </a>
      </div>
      <!-- End Logo -->
      <!-- End Search Bar -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
            <a
              class="nav-link nav-profile d-flex align-items-center pe-0"
              href="#"
              data-bs-toggle="dropdown"
            >
              <img
                src="https://www.computerhope.com/jargon/g/guest-user.png"
                alt="Profile"
                class="rounded-circle"
              />
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $name ?></span> </a
            >

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $name ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="./Logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul>
          </li>
          <!-- End Profile Nav -->
        </ul>
      </nav>
      <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php require './Aside-Nav/Aside.php'?>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1><?php echo $title ?></h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><?php echo $title ?></li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"></h5>

                <!-- Horizontal Form -->
                <form method="POST" action="./Edit_Option.php?option_id=<?php echo $option_id ?>" enctype="multipart/form-data">

                <input type="hidden" name="option_id" value="<?php echo $option_id ?>">

                  <div class="row mb-3">
                    <label for="offer" class="col-sm-2 col-form-label"
                      >Title</label
                    >
                    <div class="col-sm-10">
                      <input type="text" name="title" value="<?php echo $title ?>" class="form-control" id="offer" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="date_time" class="col-sm-2 col-form-label"
                      >Date Time</label
                    >
                    <div class="col-sm-10">
                      <input type="datetime-local" name="date_time" value="<?php echo $date_time ?>" class="form-control" id="date_time" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="quantity" class="col-sm-2 col-form-label"
                      >Quantity</label
                    >
                    <div class="col-sm-10">
                      <input type="text" name="quantity" value="<?php echo $quantity ?>" class="form-control" id="quantity" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label"
                      >Price</label
                    >
                    <div class="col-sm-10">
                      <input type="text" name="price" value="<?php echo $price ?>" class="form-control" id="price" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="price" class="col-sm-2 col-form-label"
                      >Description</label
                    >
                    <div class="col-sm-10">
                      <textarea name="description" class="form-control" id="" value="<?php echo $description ?>"><?php echo $description ?></textarea>
                    </div>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" name="has_food" type="checkbox" id="has_food" <?php echo ($has_food ? "checked" : "") ?>>
                    <label class="form-check-label" for="has_food">
                        Has Food
                    </label>
                    </div>

                  <div class="form-check">
                    <input class="form-check-input" name="has_soft_drinks" type="checkbox" id="has_soft" <?php echo ($has_soft_drinks ? "checked" : "") ?>>
                    <label class="form-check-label" for="has_soft">
                        Has Soft Drinks
                    </label>
                    </div>


                  <div class="text-end">
                    <button type="submit" name="Submit" class="btn btn-primary">
                      Submit
                    </button>
                    <button type="reset" class="btn btn-secondary">
                      Reset
                    </button>
                  </div>
                </form>
                <!-- End Horizontal Form -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>JoFind</span></strong
        >. All Rights Reserved
      </div>
    </footer>
    <!-- End Footer -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <script>
    window.addEventListener('DOMContentLoaded', (event) => {
     document.querySelector('#sidebar-nav .nav-item:nth-child(5) .nav-link').classList.remove('collapsed')
   });
</script>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
  </body>
</html>
