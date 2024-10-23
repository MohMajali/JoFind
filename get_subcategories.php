<?php
session_start();

include "./Connect.php";

if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];

    $sql2 = mysqli_query($con, "SELECT * FROM sub_categories WHERE category_id = $category_id AND active = 1 ORDER BY id DESC");

    $subcategories = [];
    while ($row2 = mysqli_fetch_assoc($sql2)) {
        $subcategories[] = ['id' => $row2['id'], 'name' => $row2['name']];
    }

    echo json_encode($subcategories);

    mysqli_close($con);
}
