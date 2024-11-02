<?php

include "../Connect.php";

$reservation_id = $_GET['reservation_id'];
$status_id = $_GET['status_id'];

$stmt = $con->prepare("UPDATE reservations SET status_id = ? WHERE id = ? ");

$stmt->bind_param("ii", $status_id, $reservation_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Reservation Has Been Accepted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Reservations.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Reservation Has Been Rejected Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Reservations.php';
</script>";
    }

}
