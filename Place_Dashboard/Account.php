<?php
session_start();

include "../Connect.php";

$P_ID = $_SESSION['P_Log'];

if (!$P_ID) {

    echo '<script language="JavaScript">
     document.location="../Place_Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from places where id = '$P_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $place_id = $row1['id'];
    $name = $row1['name'];
    $email = $row1['email'];
    $phone = $row1['phone'];
    $category_id = $row1['category_id'];

    $sql2 = mysqli_query($con, "select * from categories where id='$category_id'");
    $row2 = mysqli_fetch_array($sql2);

    $category_name = $row2['name'];

    if (isset($_POST['Submit'])) {

        $place_id = $_POST['place_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $image = $_FILES["file"]["name"];

        if ($image) {

            $image = 'Places_Images/' . $image;

            $stmt = $con->prepare("UPDATE places SET name = ?, password = ?, phone = ?, email = ?, image = ? WHERE id = ? ");

            $stmt->bind_param("sssssi", $name, $password, $phone, $email, $image, $place_id);

            if ($stmt->execute()) {

                move_uploaded_file($_FILES["file"]["tmp_name"], "./Places_Images/" . $_FILES["file"]["name"]);

                echo "<script language='JavaScript'>
                alert ('Account Updated Successfully !');
           </script>";

                echo "<script language='JavaScript'>
          document.location='./Account.php';
             </script>";

            }

        } else {

            $stmt = $con->prepare("UPDATE places SET name = ?, password = ?, phone = ?, email = ? WHERE id = ? ");

            $stmt->bind_param("ssssi", $name, $password, $phone, $email, $place_id);

            if ($stmt->execute()) {

                echo "<script language='JavaScript'>
              alert ('Account Updated Successfully !');
         </script>";

                echo "<script language='JavaScript'>
        document.location='./Account.php';
           </script>";

            }

        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Account - JoFind</title>
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
              <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $title ?></span> </a
            >

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $title ?></h6>
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
        <h1>Account</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Account</li>
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
                <form method="POST" action="./Account.php" enctype="multipart/form-data">

                <input type="hidden" name="place_id" value="<?php echo $place_id ?>">

                  <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label"
                      >Name</label
                    >
                    <div class="col-sm-10">
                      <input type="text" name="name" value="<?php echo $name ?>" class="form-control" id="name" />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label"
                      >Email</label
                    >
                    <div class="col-sm-10">
                      <input type="text" name="email" value="<?php echo $email ?>" class="form-control" id="email" />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="phone" class="col-sm-2 col-form-label"
                      >Phone</label
                    >
                    <div class="col-sm-10">
                      <input type="text" name="phone" value="<?php echo $phone ?>"
                      pattern="[0-9]{10}" title="Phone Number Must Be 10 Numbers"
                      class="form-control" id="phone" />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label"
                      >Password</label
                    >
                    <div class="col-sm-10">
                      <input type="password" name="password" value="<?php echo $password ?>" class="form-control" id="password" />
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="file" class="col-sm-2 col-form-label"
                      >Image</label
                    >
                    <div class="col-sm-10">
                      <input type="file" name="file" class="form-control" id="file" />
                    </div>
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
     document.querySelector('#sidebar-nav .nav-item:nth-child(2) .nav-link').classList.remove('collapsed')
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
