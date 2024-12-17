<?php

include "../Connect.php";

$image_id = $_GET['image_id'];

$stmt = $con->prepare("DELETE FROM place_images WHERE id = ? ");

$stmt->bind_param("i", $image_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Image Has Been Successfully !');
    </script>";

    echo "<script language='JavaScript'>
    document.location='./Images.php';
    </script>";

}
