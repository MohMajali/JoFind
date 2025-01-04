<?php
include "../Connect.php";
session_start();

$response = [
    "error" => false,
];

if (isset($_GET['customer_id']) && isset($_GET['offer_id'])) {

    $customer_id = ($_GET['customer_id']);
    $offer_id = ($_GET['offer_id']);

    $stmt = $con->prepare("INSERT INTO offer_winners (offer_id, customer_id) VALUES (?, ?)");

    $stmt->bind_param("ii", $customer_id, $offer_id);

    if ($stmt->execute()) {

        $response['error'] = false;

    } else {
        $response['error'] = true;
    }

} else {

    $response['error'] = true;
}

echo json_encode($response);
