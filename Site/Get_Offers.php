<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];

if (isset($_POST['place_id'])) {

    $place_id = $_POST['place_id'];

    if ($C_ID) {

        $cookies = $con->prepare("INSERT INTO customer_logs (customer_id, place_id) VALUES (?, ?) ");
        $cookies->bind_param("ii", $C_ID, $place_id);

    }

    $sql = mysqli_query($con, "SELECT * FROM offers WHERE place_id = $place_id AND active = 1 ORDER BY id ASC");

    $offers = [];

    while ($row = mysqli_fetch_assoc($sql)) {

        $offers[] = [
            'id' => $row['id'],
            'offer' => $row['offer'],
        ];

    }
    echo json_encode($offers);
}
