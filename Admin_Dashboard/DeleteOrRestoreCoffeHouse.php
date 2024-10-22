<?php

include "../Connect.php";
$isActive = $_GET['isActive'];
$coffee_house_id = $_GET['coffee_house_id'];

$stmt = $con->prepare("UPDATE coffee_houses SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $isActive, $coffee_house_id);

if ($stmt->execute()) {

    if ($isActive == 0) {

        echo "<script language='JavaScript'>
        alert ('Coffee House Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Coffe-Houses.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Coffee House Has Been Restored Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Coffe-Houses.php';
</script>";
    }

}
