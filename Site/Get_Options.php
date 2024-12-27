<?php

include "../Connect.php";
session_start();

$venue_id = $_GET['venue_id'];

$sql1 = mysqli_query($con, "SELECT * from booking_options WHERE active = 1 AND place_id = '$venue_id' ORDER BY id DESC");

$options = [];

while ($row1 = mysqli_fetch_array($sql1)) {

    $option_id = $row1['id'];
    $title = $row1['title'];
    $date_time = $row1['date_time'];
    $quantity = $row1['quantity'];
    $has_soft_drinks = $row1['has_soft_drinks'];
    $has_food = $row1['has_food'];
    $price = $row1['price'];

    $options[] = [
        'id' => $option_id,
        'date' => $date_time,
    ];

}

echo json_encode($options);
