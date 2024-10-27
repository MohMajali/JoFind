<?php

include "../Connect.php";

$isActive = $_GET['isActive'];
$slider_id = $_GET['slider_id'];

$stmt = $con->prepare("UPDATE sliders SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $slider_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Slider Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Sliders.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Slider Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Sliders.php';
</script>";
    }

}
