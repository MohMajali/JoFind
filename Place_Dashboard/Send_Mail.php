<?php
session_start();

include "../Connect.php";

$P_ID = $_SESSION['P_Log'];

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if (isset($_POST['send'])) {

    $subject = $_POST['subject'];
    $body = $_POST['body'];

    $sql1 = mysqli_query($con, "select * from places where id='$P_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $place_email = $row1['email'];

    $sql2 = mysqli_query($con, "select customer_id from reservations where place_id='$P_ID'");
    // $row2 = mysqli_fetch_array($sql2);
    
    // $customer_id = $row2['customer_id'];

    // $sql3 = mysqli_query($con, "select email from users where id='$customer_id'");

    $emails = [];

    while ($row1 = mysqli_fetch_array($sql2)) {

        $customer_id = $row1['customer_id'];

        $sql3 = mysqli_query($con, "select email from users where id='$customer_id'");
  
        while ($row2 = mysqli_fetch_array($sql3)) {

            $emails[] = $row2['email'];
        }

    }
    

    try {

        if (empty($emails)) {

            echo "<script language='JavaScript'>
            alert ('No Emails Found !');
       </script>";

            echo "<script language='JavaScript'>
      document.location='./Customers.php';
         </script>";

        } else {

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'findjo802@gmail.com';
            $mail->Password = 'bfarkmcgnzcxwiwm';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom($place_email);

            foreach ($emails as $email) {

                $mail->addAddress($email);

            }

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();

            echo "<script language='JavaScript'>
            alert ('Sent Successfully !');
       </script>";

            echo "<script language='JavaScript'>
      document.location='./Customers.php';
         </script>";
        }

    } catch (Exception $e) {

        echo $e;
    }
}
