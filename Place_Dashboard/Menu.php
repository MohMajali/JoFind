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

    $name = $row1['name'];
    $email = $row1['email'];

    if (isset($_POST['Submit'])) {

        $place_id = $_POST['place_id'];
        $link = $_POST['link'];
        $image = $_FILES["file"]["name"];

        $query = mysqli_query($con, "SELECT * FROM place_menus WHERE place_id ='$place_id'");
        $data = mysqli_fetch_array($query);

        if (!is_null($data['menu_link'])) {

            echo "<script language='JavaScript'>
          alert ('Venue only has menu links !');
          </script>";

            echo "<script language='JavaScript'>
          document.location='./Menu.php';
          </script>";

        } else {

            if (isset($link)) {

                $stmt = $con->prepare("INSERT INTO place_menus (place_id, menu_link) VALUES (?, ?)");

                $stmt->bind_param("is", $place_id, $link);

                if ($stmt->execute()) {

                    echo "<script language='JavaScript'>
              alert ('A New Menu Has Been Added Successfully !');
              </script>";

                    echo "<script language='JavaScript'>
              document.location='./Menu.php';
              </script>";

                }

            } else {

                $image = 'Places_Images/' . $image;

                $stmt = $con->prepare("INSERT INTO place_menus (place_id, menu_image) VALUES (?, ?)");

                $stmt->bind_param("is", $place_id, $image);

                if ($stmt->execute()) {

                    move_uploaded_file($_FILES["file"]["tmp_name"], "./Places_Images/" . $_FILES["file"]["name"]);

                    echo "<script language='JavaScript'>
                alert ('A New Menu Has Been Added Successfully !');
           </script>";

                    echo "<script language='JavaScript'>
          document.location='./Menu.php';
             </script>";

                }

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

    <title>Menu - JoFind</title>
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
        <h1>Menus</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item">Menus</li>
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
            Add New Menu
          </button>
        </div>

        <div class="modal fade" id="verticalycentered" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Menu Information</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">

                <form method="POST" action="./Menu.php" enctype="multipart/form-data">

                <input type="hidden" name="place_id" value="<?php echo $P_ID ?>">


                <div class="row mb-3">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Type</label
                    >
                    <div class="col-sm-8">
                      <!-- <input type="file" name="file" class="form-control" /> -->
                       <select name="type" class="form-select" id="typeId">
                        <option value="1">Link</option>
                        <option value="2">Image</option>
                       </select>
                    </div>
                  </div>




                  <div class="row mb-3" id="image">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Menu Image</label
                    >
                    <div class="col-sm-8">
                      <input type="file" name="file" class="form-control" />
                    </div>
                  </div>


                  <div class="row mb-3" id="link">
                    <label for="inputText" class="col-sm-4 col-form-label"
                      >Menu link</label
                    >
                    <div class="col-sm-8">
                      <input type="text" name="link" class="form-control" />
                    </div>
                  </div>


                  <script>


document.getElementById('typeId').addEventListener('change', function(e){


              if(e.target.value == 1) {

                  document.getElementById('image').style.display = 'none'
                  document.getElementById('link').style.display = 'flex'

              } else {

document.getElementById('link').style.display = 'none'
document.getElementById('image').style.display = 'flex'

              }

})
                </script>



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
                      <th scope="col">Menu Link</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>


                  <?php
$sql1 = mysqli_query($con, "SELECT * from place_menus WHERE place_id = '$P_ID' ORDER BY id DESC");

while ($row1 = mysqli_fetch_array($sql1)) {

    $image_id = $row1['id'];
    $image = $row1['menu_image'];
    $active = $row1['active'];
    $created_at = $row1['created_at'];

    ?>
                    <tr>
                      <th scope="row"><?php echo $image_id ?></th>
                      <th scope="row"><a href="<?php echo $image ?>" target="_blank">View</a></th>
                      <th scope="row"><?php echo $created_at ?></th>
                      <th scope="row">

                    <a href="./DeleteImage.php?image_id=<?php echo $image_id ?>" class="btn btn-danger">Delete</a>

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

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
  </body>
</html>
