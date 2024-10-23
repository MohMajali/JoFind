<?php

include "../Connect.php";

$isActive = $_GET['isActive'];
$place_id = $_GET['place_id'];

$stmt = $con->prepare("UPDATE places SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $place_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Place Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Places.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Place Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Places.php';
</script>";
    }

}
