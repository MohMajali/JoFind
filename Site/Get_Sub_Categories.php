<?php
session_start();

include "../Connect.php";

if (isset($_POST['category_id'])) {

    $category_id = $_POST['category_id'];

    $sql = mysqli_query($con, "SELECT * FROM sub_categories WHERE category_id = $category_id AND active = 1 ORDER BY id ASC");

    $subcategories = [];

    while ($row = mysqli_fetch_assoc($sql)) {

        $subcategories[] = $row;
        
    }
    echo json_encode($subcategories);
}
