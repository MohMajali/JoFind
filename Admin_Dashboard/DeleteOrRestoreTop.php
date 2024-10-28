<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$top_id = $_GET['top_id'];

$stmt = $con->prepare("UPDATE tops SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $top_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Top Venue Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Tops_Venues.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Top Venue Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Tops_Venues.php';
</script>";
    }

}
