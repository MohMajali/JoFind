<?php
session_start();

include "../Connect.php";

$A_ID = $_SESSION['A_Log'];

$place_id = $_GET['place_id'];
$type = $_GET['type'];

if (!$A_ID) {

    echo '<script language="JavaScript">
     document.location="../Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from users where id='$A_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    $sql2 = mysqli_query($con, "select * from places where id='$place_id'");
    $row2 = mysqli_fetch_array($sql2);

    $venue_name = $row2['name'];


    $sqlQuery = "SELECT * from place_subscriptions ORDER BY id DESC";

    if(isset($place_id)) {

      $sqlQuery = "SELECT * from place_subscriptions WHERE place_id = '$place_id' ORDER BY id DESC";
      
    } else if(isset($type)) {
      
      $sqlQuery = "SELECT * from place_subscriptions WHERE subscription_type LIKE '%$type%' ORDER BY id DESC";
    }
 
    
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title><?php echo $venue_name ?> Subscriptions - JoFind</title>
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
        <h1><?php echo $venue_name ?> Subscriptions</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><?php echo $venue_name ?> Subscriptions</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">

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

      <div class="mb-3">

<input type="button" value="PRINT REPORT" class="btn btn-primary" onclick="printDiv()">
</div>


        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" id="div_print">









              <form action="<?php echo $place_id ? './Subscriptions.php?place_id=' . $place_id : './Subscriptions.php' ?>">




<select name="place_id" id="">

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




<select name="type" id="">

<option value="" selected disabled>Select Subscription type</option>
<option value="3 Months Open Contract (First Time Only) (For Free)">3 Months Open Contract (First Time Only) (For Free)</option>
                            <option value="6 Months Contract (300 JOD)">6 Months Contract (300 JOD)</option>
                            <option value="12 Months COntract (600 JOD)">12 Months COntract (600 JOD)</option>
</select>


<button type="submit" >Filter</button>
</form>


                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Venue Name</th>
                      <th scope="col">Subscription Type</th>
                      <th scope="col">Start Date</th>
                      <th scope="col">End Date</th>
                      <th scope="col">Price</th>
                      <th scope="col">Status</th>
                      <th scope="col">Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
$sql1 = mysqli_query($con, $sqlQuery);

while ($row1 = mysqli_fetch_array($sql1)) {

    $subscription_id = $row1['id'];
    $place_id = $row1['place_id'];
    $subscription_type = $row1['subscription_type'];
    $start_date = $row1['start_date'];
    $end_date = $row1['end_date'];
    $price = $row1['price'];
    $active = $row1['active'];
    $created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from places WHERE id = '$place_id'");
    $row2 = mysqli_fetch_array($sql2);

    $venue_name = $row2['name'];

    ?>
                    <tr>
                      <th scope="row"><?php echo $place_id ?></th>
                      <th scope="row"><?php echo $venue_name ?></th>
                      <th scope="row"><?php echo $subscription_type ?></th>
                      <th scope="row"><?php echo $start_date ?></th>
                      <th scope="row"><?php echo $end_date ?></th>
                      <th scope="row"><?php echo $price ?> JOD</th>
                      <th scope="row"><?php echo $active == 1 ? 'Active' : 'Expired' ?></th>
                      <th scope="row"><?php echo $created_at ?></th>
                    </tr>
<?php
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
     document.querySelector('#sidebar-nav .nav-item:nth-child(7) .nav-link').classList.remove('collapsed')
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
