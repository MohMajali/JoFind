<?php

include "../Connect.php";

$id = $_GET['id'];

$stmt = $con->prepare("DELETE FROM favorites WHERE id = ? ");

$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('Deleted Successfully !');
        </script>";

    echo "<script language='JavaScript'>
        document.location='./Favorties.php';
        </script>";

}
