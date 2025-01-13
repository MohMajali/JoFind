<?php

include "../Connect.php";

$feedback_id = $_GET['feedback_id'];

$stmt = $con->prepare("DELETE FROM feedbacks WHERE id = ?");

$stmt->bind_param("i", $feedback_id);

if ($stmt->execute()) {

    echo "<script language='JavaScript'>
        alert ('Feedback Deleted !');
        </script>";

    echo "<script language='JavaScript'>
        document.location='./Feedbacks.php';
        </script>";

}
