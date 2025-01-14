<?php
session_start();

include "./Connect.php";

if (isset($_POST['Submit'])) {

    $name = $_POST['name'];
    $password = ($_POST['password']);
    $confirm_password = ($_POST['confirm_password']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $image = $_FILES["file"]["name"];
    $image = 'Users_Images/' . $image;
    $userType = 2;



    if($password !== $confirm_password) {

      echo "<script language='JavaScript'>
      alert ('Passwords Does Not Match!');
 </script>";

    } else {

      $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");

      if (mysqli_num_rows($query) > 0) {
  
          echo "<script language='JavaScript'>
        alert ('Account Already Exist !');
   </script>";
  
      } else {
  
          $stmt = $con->prepare("INSERT INTO users (type_id, name, email, password, phone, image) VALUES (?, ?, ?, ?, ?, ?) ");
  
          $stmt->bind_param("isssss", $userType, $name, $email, $password, $phone, $image);
  
          if ($stmt->execute()) {
  
            
            move_uploaded_file($_FILES["file"]["tmp_name"], "./Site/Users_Images/" . $_FILES["file"]["name"]);
  
              echo "<script language='JavaScript'>
              alert ('Customer Registered Successfully !');
         </script>";
  
              echo "<script language='JavaScript'>
        document.location='./Login.php';
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

    <title>Register Page</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/Logo.png" rel="icon" />
    <link href="assets/img/Logo.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <main>
      <div class="container">
        <section
          class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div
                class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center"
              >
                <div class="d-flex justify-content-center py-4">
                  <a
                    href="index.php"
                    class="logo d-flex align-items-center w-auto"
                  >
                    <img src="assets/img/Logo.png" alt="" width="50px"/>
                    <span class="d-none d-lg-block text-uppercase"
                      >JoFind</span
                    >
                  </a>
                </div>
                <!-- End Logo -->

                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">
                        Create New Account
                      </h5>
                      <p class="text-center small">
                        Enter Information
                      </p>
                    </div>

                    <form class="row g-3 needs-validation" method="POST" action="./Register.php" enctype="multipart/form-data" id="signup-form">

                      <div class="col-12">
                        <label for="name" class="form-label required">Name</label>
                        <div class="input-group has-validation">

                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            pattern="[A-Za-z]+"
  title="Only alphabetic characters are allowed."
  oninput="this.value = this.value.replace(/[^a-zA-Z]+/g, '');"
                            required
                          />

                        </div>
                      </div>

                      <div class="col-12">
                        <label for="name" class="form-label required">Email</label>
                        <div class="input-group has-validation">

                          <input
                            type="email"
                            name="email"
                            class="form-control"
                            id="email"
                            required
                          />

                        </div>
                      </div>


                      <div class="col-12">
                        <label for="name" class="form-label required">Phone</label>
                        <div class="input-group has-validation">

                          <input
                            type="text"
                            name="phone"
                            class="form-control"
                            id="phone"
                            pattern="[0-9]{10}" title="Phone Number Must Be 10 Numbers"
                            required
                          />

                        </div>
                      </div>



                      <div class="col-12">
                        <label for="yourPassword" class="form-label required"
                          >Password</label
                        >
                        <input
                          type="password"
                          name="password"
                          class="form-control"
                          id="yourPassword"
                          required
                        />
                        <div class="invalid-feedback" id="password-Message">
                          Please enter your password!
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="confirmpassowrd" class="form-label required"
                          >Confirm Password</label
                        >
                        <input
                          type="password"
                          name="confirm_password"
                          class="form-control"
                          id="confirmpassowrd"
                          required
                        />
    <div class="invalid-feedback" id="con">
      Passwords do not match!
    </div>
                 
                      </div>

                      <div class="col-12">
                        <label for="yourpicture" class="form-label required"
                          >Image</label
                        >
                        <input
                          type="file"
                          name="file"
                          class="form-control"
                          id="yourpicture"
                          required
                        />
               
                      </div>


                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit" name="Submit">
                          Signup
                        </button>
                      </div>
                      <div class="col-12">
                        <p class="small mb-0">
                          Already Have Account
                          <a href="./Place_Login.php">Login Now</a>
                        </p>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <!-- End #main -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>



document.getElementById('signup-form').addEventListener('submit', function(event) {
    const password = document.getElementById('yourPassword').value;
    const confirmPassword = document.getElementById('confirmpassowrd').value;

    if (password !== confirmPassword) {
        // Prevent form submission
        event.preventDefault();
        // alert('Passwords do not match!');
        // Optionally, focus the confirmPassword field
        document.getElementById('con').style.display = 'block';

        // document.getElementById('confirmPassword').focus();
    }
});


    </script>
  </body>
</html>
