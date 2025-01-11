<?php
session_start();

include "../Connect.php";

$A_ID = $_SESSION['A_Log'];

$placeId_query = $_GET['placeId'];
$created_at_query = $_GET['created_at'];
$category_id_query = $_GET['category_id'];

$sqlQuery = "SELECT * from reservations ORDER BY id DESC";

if (!$A_ID) {

    echo '<script language="JavaScript">
     document.location="../Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from users where id='$A_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    if ($placeId_query && $created_at_query) {

        $sqlQuery = "SELECT * from reservations WHERE place_id = '$placeId_query' AND created_at LIKE '%$created_at_query%' ORDER BY id DESC";

    } else if ($placeId_query) {

        $sqlQuery = "SELECT * from reservations WHERE place_id = '$placeId_query' ORDER BY id DESC";

    } else if ($created_at_query) {

        $sqlQuery = "SELECT * from reservations WHERE created_at LIKE '%$created_at_query%' ORDER BY id DESC";

    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Users - JoFind</title>
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
        <h1>Reservation</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Reservation</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">


      <div class="mb-3">

<input type="button" value="PRINT REPORT" class="btn btn-primary" onclick="printDiv()">
</div>

        <div class="row" >
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" id="div_print">
                <!-- Table with stripped rows -->

                <form action="./Reservations.php">



                <select name="category_id" id="">

                <option value="" selected disabled>Select Category</option>
                  <?php
$sql323232 = mysqli_query($con, "SELECT * from categories WHERE active = 1 ORDER BY id DESC");

while ($row323232 = mysqli_fetch_array($sql323232)) {

    $category_id = $row323232['id'];
    $category_name = $row323232['name'];

    ?>

<option value="<?php echo $category_id ?>"><?php echo $category_name ?></option>
    <?php
}?>
                </select>




                <select name="placeId" id="">

                <option value="" selected disabled>Select Venue</option>
                  <?php
$sql4444 = mysqli_query($con, "SELECT * from places WHERE active = 1 ORDER BY id DESC");

while ($row44444 = mysqli_fetch_array($sql4444)) {

    $place_id = $row44444['id'];
    $place_name = $row44444['name'];

    ?>

<option value="<?php echo $place_id ?>"><?php echo $place_name ?></option>
    <?php
}?>
                </select>



                <input type="date" name="created_at" placeholder="Created At">

                <button type="submit" >Filter</button>
                </form>
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Customer</th>
                      <th scope="col">Venue</th>
                      <th scope="col">Category</th>
                      <th scope="col">Date Time</th>
                      <th scope="col">Offer</th>
                      <th scope="col">Price</th>
                      <!-- <th scope="col">Total Price</th> -->
                      <th scope="col">Status</th>
                      <th scope="col">Created At</th>
                    </tr>
                  </thead>
                  <tbody>


                  <?php
$sql1 = mysqli_query($con, $sqlQuery);

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
    $category_id = $row2['category_id'];

    $sql2322 = mysqli_query($con, "SELECT * from categories WHERE id = '$category_id'");
    $row2322 = mysqli_fetch_array($sql2322);

    $category_name = $row2322['name'];

    $sql3 = mysqli_query($con, "SELECT * from users WHERE id = '$customer_id'");
    $row3 = mysqli_fetch_array($sql3);

    $customer_name = $row3['name'];
    $customer_email = $row3['email'];

    $sql4 = mysqli_query($con, "SELECT * from statuses WHERE id = '$status_id'");
    $row4 = mysqli_fetch_array($sql4);

    $status = $row4['name'];

    $sql5 = mysqli_query($con, "SELECT * from offers WHERE id = '$offer_id'");
    $row5 = mysqli_fetch_array($sql5);

    $offer = $row5['offer'];

    if ($category_id_query == $category_id) {

        ?>
                    <tr>
                      <th scope="row"><?php echo $reservation_id ?></th>
                      <td scope="row"><?php echo $customer_name ?></td>
                      <td scope="row"><?php echo $venue_name ?></td>
                      <td scope="row"><?php echo $category_name ?></td>
                      <td scope="row"><?php echo $date_time ?></td>
                      <th scope="row"><?php echo $offer ?></th>
                      <th scope="row"><?php echo $price ?></th>
                      <!-- <th scope="row"><?php echo $total_price ?></th> -->
                      <th scope="row"><?php echo $status ?></th>
                      <th scope="row"><?php echo $created_at ?></th>
                    </tr>
<?php
}
}?>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
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
     document.querySelector('#sidebar-nav .nav-item:nth-child(9) .nav-link').classList.remove('collapsed')
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


    <script>
        function printDiv() {
            var divContents = document.getElementById("div_print").innerHTML;
            var a = window.open('', '', 'height=1000, width=5000');
            a.document.write('<html>');
            a.document.write('<body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
  </body>
</html>
