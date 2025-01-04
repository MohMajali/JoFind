<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];
$venue_id = $_GET['venue_id'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

    $cookies = $con->prepare("INSERT INTO customer_logs (customer_id, place_id) VALUES (?, ?) ");
    $cookies->bind_param("ii", $C_ID, $venue_id);

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HangMan</title>
    <link rel="stylesheet" href="./game.css">
</head>
<body>
    
    <!-- Start Welcome Section-->
    <section class="welcome-section">
        <!-- <img class="logo p-top-15" src="./images/logo.jpg" alt="logo"> -->
        <!-- <h3 class="welcome p-top-15 m-b-20">Welcome To HangMan</h3> -->

        <div class="form">
            <label id="user-label" class="user-label-cl" for="">User Name</label>
            <input class="user-name m-b-20 m-b-20 m-t-15" type="text" placeholder="Write your name">
            <button class="btn">Let's Game</button>
        </div>
    </section>
    <!-- End Welcome Section -->

    <!-- Start Home Page -->
    <section class="home-page">
        <!-- <img class="logo p-top-15" src="./images/logo.jpg" alt="logo"> -->
    </section>
    <!-- End Home Page -->

    <!-- Start Game Page -->
    <section id="gm-sc" class="game-section hide">
        <div id="letter-container" class="letter-container hide"></div>
        <audio id="myAudio" controls>
            <source src="./videos/epic-hybrid-logo-157092.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <p id="demo" class="timer"></p>
        <div id="user-input-section"></div>
        <canvas id="canvas"></canvas>
        <div id="new-game-container" class="new-game-pop hide">
            <div id="result-text"></div>
            <div id="balloon-container"></div>
            <button id="new-game-button" class="buttons">New Game</button>
            <button id="logout" class="buttons m-t-15">Logout</button>
        </div>
    </section>
    <!-- End Game Page -->


    <script type="text/javascript">
    var venueId = <?php echo json_encode($venue_id); ?>;
    var CID = <?php echo json_encode($C_ID); ?>;
</script>

    <script src="./game.js"></script>
</body>
</html>