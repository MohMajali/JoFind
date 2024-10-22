<?php

include "../Connect.php";

$isActive = $_GET['isActive'];
$cafe_id = $_GET['cafe_id'];

$stmt = $con->prepare("UPDATE cafes SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $cafe_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Cafe Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Cafes.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Cafe Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Cafes.php';
</script>";
    }

}
