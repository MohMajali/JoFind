<?php
include "../Connect.php";
session_start();

$response = [
    "error" => false,
];

if (isset($_GET['customer_id']) && isset($_GET['venue_id'])) {

    $customer_id = ($_GET['customer_id']);
    $venue_id = ($_GET['venue_id']);

    $query = mysqli_query($con, "SELECT * FROM favorites WHERE venue_id ='$venue_id' AND customer_id = '$customer_id'");

    if (mysqli_num_rows($query) > 0) {

        $response['error'] = true;
        $response['message'] = 'Already in favorites';

    } else {

        $stmt = $con->prepare("INSERT INTO favorites (customer_id, venue_id) VALUES (?, ?)");

        $stmt->bind_param("ii", $customer_id, $venue_id);

        if ($stmt->execute()) {

            $response['error'] = false;

        } else {
            $response['error'] = true;
        }
    }

} else {

    $response['error'] = true;
}

echo json_encode($response);
