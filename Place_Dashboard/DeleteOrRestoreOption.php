<?php

include "../Connect.php";

$isActive = $_GET['isActive'];
$option_id = $_GET['option_id'];

$stmt = $con->prepare("UPDATE booking_options SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $option_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Option Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Booking_Options.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Option Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Booking_Options.php';
</script>";
    }

}
