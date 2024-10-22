<?php

include "../Connect.php";
$status = $_GET['status'];
$gym_id = $_GET['gym_id'];

$stmt = $con->prepare("UPDATE gyms SET status = ? WHERE id = ? ");

$stmt->bind_param("si", $status, $gym_id);

if ($stmt->execute()) {

    if ($status == 'Accepted') {

        echo "<script language='JavaScript'>
        alert ('Gym Has Been Accepted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Gyms_Requestes.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Category Has Been Rejected Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Gyms_Requestes.php';
</script>";
    }

}
