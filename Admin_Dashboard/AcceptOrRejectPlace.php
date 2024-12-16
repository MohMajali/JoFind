<?php

include "../Connect.php";

$status = $_GET['status'];
$place_id = $_GET['place_id'];
$rejection_note = $_GET['rejection_note'];

$stmt = $con->prepare("UPDATE places SET status_id = ? WHERE id = ? ");

$stmt->bind_param("ii", $status, $place_id);

if ($stmt->execute()) {

    if ($status == 2) {

        echo "<script language='JavaScript'>
        alert ('Place Has Been Accepted !');
        </script>";

        echo "<script language='JavaScript'>
        document.location='./New_Requestes.php';
        </script>";

    } else {

        $stmt = $con->prepare("UPDATE places SET rejection_note = ? WHERE id = ? ");

        $stmt->bind_param("si", $rejection_note, $place_id);

        $stmt->execute();

        echo "<script language='JavaScript'>
alert ('Place Has Been Rejected !');
</script>";

        echo "<script language='JavaScript'>
document.location='./New_Requestes.php';
</script>";
    }

}
