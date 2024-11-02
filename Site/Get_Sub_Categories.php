<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];

if (isset($_POST['category_id'])) {

    $category_id = $_POST['category_id'];

    if ($C_ID) {

        $cookies = $con->prepare("INSERT INTO customer_logs (customer_id, category_id) VALUES (?, ?) ");
        $cookies->bind_param("ii", $C_ID, $category_id);
    }

    $sql = mysqli_query($con, "SELECT * FROM sub_categories WHERE category_id = $category_id AND active = 1 ORDER BY id ASC");

    $subcategories = [];

    while ($row = mysqli_fetch_assoc($sql)) {

        $subcategories[] = $row;

    }
    echo json_encode($subcategories);
}
