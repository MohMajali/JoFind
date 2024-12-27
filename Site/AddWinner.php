<?php
include "../Connect.php";
session_start();

$response = [
    "error" => false
];

if (isset($_POST['customer_id']) && isset($_POST['offer_id'])) {

    $response['offer_id'] = $_POST['offer_id'] ?? "noooooo";
    $response['customer_id'] = $_POST['customer_id'] ?? "cussssssss";

    $customer_id = intval($_POST['customer_id']);
    $offer_id = intval($_POST['offer_id']);

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
