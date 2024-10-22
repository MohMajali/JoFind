<?php

include "../Connect.php";
$active = $_GET['active'];
$manager_id = $_GET['manager_id'];

$stmt = $con->prepare("UPDATE users SET active = ? WHERE id = ? ");

$stmt->bind_param("ii", $active, $manager_id);

if ($stmt->execute()) {

    if ($active == 0) {

        echo "<script language='JavaScript'>
        alert ('Manager Has Been Deleted Successfully !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./Gym_Managers.php';
        </script>";

    } else {
        echo "<script language='JavaScript'>
alert ('Manager Has Been Activated Successfully !');
</script>";

        echo "<script language='JavaScript'>
document.location='./Gym_Managers.php';
</script>";
    }

}
