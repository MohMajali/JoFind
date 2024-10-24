<?php
session_start();

include "../Connect.php";

$A_ID = $_SESSION['A_Log'];

if (!$A_ID) {

    echo '<script language="JavaScript">
     document.location="../Login.php";
    </script>';

} else {

    $sql1 = mysqli_query($con, "select * from users where id='$A_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $name = $row1['name'];
    $email = $row1['email'];

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Gyms Requestes - JoFind</title>
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
        <h1>Gyms</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Gyms</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      <section class="section">



        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Image</th>
                      <th scope="col">Manager Name</th>
                      <th scope="col">Title</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th scope="col">City</th>
                      <th scope="col">Contract Type</th>
                      <th scope="col">Duration</th>
                      <th scope="col">Status</th>
                      <!-- <th scope="col">Created At</th> -->
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
$sql1 = mysqli_query($con, "SELECT * from gyms WHERE status = 'PENDING' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $gym_id = $row1['id'];
    $manager_id = $row1['manager_id'];
    $gym_image = $row1['image'];
    $gym_name = $row1['title'];
    $gym_email = $row1['email'];
    $gym_phone = $row1['phone'];
    $gym_city = $row1['city'];
    $status = $row1['status'];
    $active = $row1['active'];
    $created_at = $row1['created_at'];

    $sql2 = mysqli_query($con, "SELECT * from users WHERE id = '$manager_id'");
    $row2 = mysqli_fetch_array($sql2);

    $manager_name = $row2['name'];

    $sql3 = mysqli_query($con, "SELECT * from gyms_contracts WHERE gym_id = '$gym_id'");
    $row3 = mysqli_fetch_array($sql3);

    $contract_type = $row3['contract_type'];
    $start_date = $row3['start_date'];
    $end_date = $row3['end_date'];

    ?>
                    <tr>
                      <th scope="row"><?php echo $gym_id ?></th>
                      <th scope="row"><img src="../Gym_Dashboard/<?php echo $gym_image ?>" alt="" width="150px" height="150px"></th>
                      <th scope="row"><?php echo $manager_name ?></th>
                      <td><?php echo $gym_name ?></td>
                      <td><?php echo $gym_email ?></td>
                      <td><?php echo $gym_phone ?></td>
                      <td><?php echo $gym_city ?></td>
                      <td><?php echo $contract_type ?></td>
                      <td><?php echo $start_date ?> - <?php echo $end_date ?></td>
                      <td><?php echo $status ?></td>
                      <!-- <th scope="row"><?php echo $created_at ?></th> -->
                      <td>



    <?php
if ($status == 'PENDING') {?>

    <a href="./AcceptOrRejectGym.php?gym_id=<?php echo $gym_id ?>&&status=Accepted" class="btn btn-primary">Accept</a>
    <a href="./AcceptOrRejectGym.php?gym_id=<?php echo $gym_id ?>&&status=Rejected" class="btn btn-danger">Reject</a>

     <?php } else {?>





                        <?php if ($active == 1) {?>

<a href="./DeleteOrRestoreGym.php?gym_id=<?php echo $gym_id ?>&&isActive=<?php echo 0 ?>" class="btn btn-danger">Delete</a>

<?php } else {?>

  <a href="./DeleteOrRestoreGym.php?gym_id=<?php echo $gym_id ?>&&isActive=<?php echo 1 ?>" class="btn btn-primary">Restore</a>

<?php }?>
     <?php }
    ?>

                      </td>
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
     document.querySelector('#sidebar-nav .nav-item:nth-child(3) .nav-link').classList.remove('collapsed')
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
