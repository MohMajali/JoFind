<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];

if (isset($_POST['latitude']) && isset($_POST['longitude'])) {

    $userLatitude = $_POST['latitude'];
    $userLongitude = $_POST['longitude'];
    $radius = 10;

    $query = "
        SELECT p.id AS place_id, p.name AS place_name, p.image AS place_image, c.name AS category_name,
               pl.latitude, pl.longitude,
               (6371 * acos(cos(radians($userLatitude)) * cos(radians(pl.latitude))
               * cos(radians(pl.longitude) - radians($userLongitude))
               + sin(radians($userLatitude)) * sin(radians(pl.latitude)))) AS distance
        FROM places p
        JOIN categories c ON p.category_id = c.id
        JOIN place_locations pl ON p.id = pl.place_id
        WHERE p.active = 1 AND p.status_id = 2 AND pl.active = 1
        HAVING distance < $radius
        ORDER BY distance
        LIMIT 0, 10";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $place_id = $row['place_id'];
            $place_name = $row['place_name'];
            $place_image = $row['place_image'];
            $category_name = $row['category_name'];
            $distance = round($row['distance'], 2);

            if ($C_ID) {

                echo "
                <div class='col-lg-3 col-md-6 col-sm-12 pb-1'>
                    <div style='background-color: #051F20 !important;' class='card product-item border-0 mb-4'>
                        <div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'>
                            <img class='img-fluid w-100' src='../Place_Dashboard/$place_image' alt='$place_name'>
                        </div>
                        <div class='card-body border-left border-right text-center p-0 pt-4 pb-3'>
                            <h6 style='color: #DAC1B1 !important;' class='text-truncate mb-3'>$place_name</h6>
                            <div class='d-flex justify-content-center'>
                                <h6 style='color: #DAC1B1 !important;'>$category_name</h6>
                                <h6 style='color: #DAC1B1 !important;' class='text-muted ml-2'>$distance km away</h6>
                            </div>
                        </div>


                        <div style='background-color: #051F20 !important;' class='card-footer d-flex justify-content-between bg-light border'>
                            <a style='color: #DAC1B1 !important;' href='Venue.php?venue_id=$place_id' class='btn btn-sm text-dark p-0'>
                                <i class='fas fa-eye text-primary mr-1'></i>View Details
                            </a>
                        </div>

                    </div>
                </div>";
            } else {
                echo "
                <div class='col-lg-3 col-md-6 col-sm-12 pb-1'>
                    <div class='card product-item border-0 mb-4'>
                        <div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'>
                            <img class='img-fluid w-100' src='../Place_Dashboard/$place_image' alt='$place_name'>
                        </div>
                        <div class='card-body border-left border-right text-center p-0 pt-4 pb-3'>
                            <h6 class='text-truncate mb-3'>$place_name</h6>
                            <div class='d-flex justify-content-center'>
                                <h6>$category_name</h6>
                                <h6 class='text-muted ml-2'>$distance km away</h6>
                            </div>
                        </div>
                    </div>
                </div>";

            }
        }
    } else {
        echo "<p>No nearby places found within a {$radius} km radius.</p>";
    }
}
