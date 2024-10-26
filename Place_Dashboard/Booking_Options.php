<?php
session_start();

include "../Connect.php";

$P_ID = $_SESSION['P_Log'];

if (!$P_ID) {

    echo '<script language="JavaScript">
     document.location="../Place_Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from places where id='$P_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

    if (isset($_POST['Submit'])) {

        $place_id = $_POST['place_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date_time = date('Y-m-d H:i:s', strtotime($_POST['date_time']));
        $quantity = $_POST['quantity'];
        $has_food = $_POST['has_food'] == 'on' ? true : false;
        $has_soft_drinks = $_POST['has_soft_drinks'] == 'on' ? true : false;
        $price = $_POST['price'];

        $stmt = $con->prepare("INSERT INTO booking_options (place_id, title, description, date_time, quantity, has_soft_drinks, has_food, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");

        $stmt->bind_param("isssiiid", $place_id, $title, $description, $date_time, $quantity, $has_soft_drinks, $has_food, $price);

        if ($stmt->execute()) {

            echo "<script language='JavaScript'>
            alert ('A New Option Has Been Added Successfully !');
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

    <title>Booking Options - JoFind</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="../assets/img/Logo.jpg" rel="icon" />
    <link href="../assets/img/Logo.jpg" rel="apple-touch-icon" />

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
          <img src="../assets/img/Logo.jpg" alt="" />

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
        <h1>Booking Options</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Booking Options</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">
      <div class="mb-3">
          <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#verticalycentered"
          >
            Add New Offer
          </button>
        </div>



        <div class="modal fade" id="verticalycentered" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Category Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Booking_Options.php" enctype="multipart/form-data">

<input type="hidden" name="place_id" value="<?php echo $P_ID ?>">

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Title</label
                    >
                    <div class="col-sm-8">
                      <input type="text" name="title" class="form-control" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Date Time</label
                    >
                    <div class="col-sm-8">
                    <input type="datetime-local" name="date_time" class="form-control" min="<?php echo date('Y-m-d\TH:i'); ?>" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Quantity</label
                    >
                    <div class="col-sm-8">
                      <input type="number" name="quantity" class="form-control" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Price</label
                    >
                    <div class="col-sm-8">
                      <input type="number" name="price" class="form-control" step="0.01" required/>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Description</label
                    >
                    <div class="col-sm-8">
                       <textarea name="description" class="form-control" id="" required></textarea>
                    </div>
                  </div>




                  <div class="form-check">
                    <input class="form-check-input" name="has_food" type="checkbox" id="has_food">
                    <label class="form-check-label" for="has_food">
                        Has Food
                    </label>
                    </div>

                  <div class="form-check">
                    <input class="form-check-input" name="has_soft_drinks" type="checkbox" id="has_soft">
                    <label class="form-check-label" for="has_soft">
                        Has Soft Drinks
                    </label>
                    </div>

                  <div class="row mb-3">
                    <div class="text-end">
                      <button type="submit" name="Submit" class="btn btn-primary">
                        Submit
                      </button>
                    </div>
                  </div>
                </form>

              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>



        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Title</th>
                      <th scope="col">Date Time</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Has Soft Drinks</th>
                      <th scope="col">Has Food</th>
                      <th scope="col">Price</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
$sql1 = mysqli_query($con, "SELECT * from booking_options WHERE place_id = '$P_ID' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $option_id = $row1['id'];
    $title = $row1['title'];
    $date_time = $row1['date_time'];
    $quantity = $row1['quantity'];
    $has_soft_drinks = $row1['has_soft_drinks'];
    $has_food = $row1['has_food'];
    $price = $row1['price'];
    $created_at = $row1['created_at'];
    $active = $row1['active'];

    ?>
                    <tr>
                      <th scope="row"><?php echo $option_id ?></th>
                      <th scope="row"><?php echo $title ?></th>
                      <th scope="row"><?php echo date('Y-m-d H:i:s', strtotime($date_time)) ?></th>
                      <th scope="row"><?php echo $quantity ?></th>
                      <th scope="row"><?php echo ($has_soft_drinks ? "Yes" : "No") ?></th>
                      <th scope="row"><?php echo ($has_food ? "Yes" : "No") ?></th>
                      <th scope="row"><?php echo $created_at ?></th>
                      <th scope="row"><?php echo $price ?> JODs</th>

                      <th>
                      <a href="./Edit_Option.php?option_id=<?php echo $option_id ?>" class="btn btn-success me-2"
                          >Edit</a
                        >

                        <?php if ($active == 1) {?>

<a href="./DeleteOrRestoreOption.php?option_id=<?php echo $option_id ?>&isActive=<?php echo 0 ?>" class="btn btn-danger">Delete</a>

<?php } else {?>

  <a href="./DeleteOrRestoreOption.php?option_id=<?php echo $option_id ?>&isActive=<?php echo 1 ?>" class="btn btn-primary">Restore</a>

<?php }?>
                      </th>
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
