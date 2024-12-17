<?php

include "../Connect.php";

$menu_id = $_GET['menu_id'];

$stmt = $con->prepare("DELETE FROM place_menus WHERE id = ? ");

$stmt->bind_param("i", $image_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
    alert ('Image Has Been Successfully !');
    </script>";

    echo "<script language='JavaScript'>
    document.location='./Images.php';
    </script>";

}
