<?php
session_start();

include "../Connect.php";

$C_ID = $_SESSION['C_Log'];
$venue_id = $_GET['venue_id'];

if ($C_ID) {

    $sql1 = mysqli_query($con, "select * from users where id='$C_ID'");
    $row1 = mysqli_fetch_array($sql1);

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>JOFind</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link href="../assets/img/Logo.png" rel="icon" />
    <link href="../assets/img/Logo.png" rel="apple-touch-icon" />

    <style>
        body{
            background-color: #333;
        }

        .header{
            padding: 40px;
            color: #fff;
            margin: 0 auto;
            margin-bottom: 40px;
        }
        .header h1,p{
            text-align: center;
        }

        .wheel{
            display: flex;
            justify-content: center;
            position: relative;
        }
        .center-circle{
            width: 100px;
            height: 100px;
            border-radius: 60px;
            background-color: #fff;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        .triangle{
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-right: 30px solid white;
            position: absolute;
            top: 50%;
            right: -220%;
            transform: translateY(-50%);
        }
        textarea{
            background-color: rgba(20, 20, 20, 0.2);
            caret-color: #fff;
            resize: none;
            color: #fff;
        }
        .inputArea{
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
    </style>

</head>

<body >
    <div class="header">
        <h1>WINNER</h1>
        <p id="winner">NONE</p>
    </div>
    <div class="wheel">
        <canvas class="" id="canvas" width="500" height="500"></canvas>
        <div class="center-circle" onclick="spin()">
            <div class="triangle"></div>
        </div>

    </div>
    <div class="inputArea" onchange="createWheel()">

    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script>
        function randomColor(){
            r = Math.floor(Math.random() * 255);
            g = Math.floor(Math.random() * 255);
            b = Math.floor(Math.random() * 255);
            return {r,g,b}
        }
        function toRad(deg){
            return deg * (Math.PI / 180.0);
        }
        function randomRange(min,max){
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
        function easeOutSine(x) {
            return Math.sin((x * Math.PI) / 2);
        }
        // get percent between 2 number
        function getPercent(input,min,max){
            return (((input - min) * 100) / (max - min))/100
        }
    </script>

    <script>
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");
const width = canvas.width;
const height = canvas.height;

const centerX = width / 2;
const centerY = height / 2;
const radius = width / 2;

const venue_id = <?php echo json_encode($venue_id); ?>;
let items = [];

// Fetch items and initialize wheel after items are loaded
$.ajax({
    url: './Get_Offers.php',
    type: 'POST',
    data: { place_id: venue_id },
    success: function(response) {
        items = JSON.parse(response);
        setupWheel();
    },
    error: function() {
        alert('Error loading subcategories.');
    }
});

let currentDeg = 0;
let colors = [];
let itemDegs = {};
let step = 360 / items.length; // Angle step for each segment

function setupWheel() {
    step = 360 / items.length;

    // Generate random colors for each segment
    for (let i = 0; i < items.length; i++) {
        colors.push(randomColor());
    }

    draw();
}

function draw() {
    ctx.clearRect(0, 0, width, height); // Clear canvas

    // Draw background circle
    ctx.beginPath();
    ctx.arc(centerX, centerY, radius, toRad(0), toRad(360));
    ctx.fillStyle = `rgb(33, 33, 33)`;
    ctx.fill();

    // Draw each segment
    let startDeg = currentDeg;
    for (let i = 0; i < items.length; i++, startDeg += step) {
        let endDeg = startDeg + step;
        let color = colors[i];
        let colorStyle = `rgb(${color.r}, ${color.g}, ${color.b})`;
        let colorStyle2 = `rgb(${color.r - 30}, ${color.g - 30}, ${color.b - 30})`;

        // Draw segment with gradient color
        ctx.beginPath();
        ctx.arc(centerX, centerY, radius - 2, toRad(startDeg), toRad(endDeg));
        ctx.fillStyle = colorStyle2;
        ctx.lineTo(centerX, centerY);
        ctx.fill();

        ctx.beginPath();
        ctx.arc(centerX, centerY, radius - 30, toRad(startDeg), toRad(endDeg));
        ctx.fillStyle = colorStyle;
        ctx.lineTo(centerX, centerY);
        ctx.fill();

        // Draw text
        ctx.save();
        ctx.translate(centerX, centerY);
        ctx.rotate(toRad((startDeg + endDeg) / 2));
        ctx.textAlign = "center";
        ctx.fillStyle = (color.r > 150 || color.g > 150 || color.b > 150) ? "#000" : "#fff";
        ctx.font = 'bold 24px serif';
        ctx.fillText(items[i].offer, 130, 10); // Use items[i].offer if items is an array of objects with offer property
        ctx.restore();

        itemDegs[items[i]] = {
            startDeg: startDeg,
            endDeg: endDeg
        };

        // Check winner
        if (startDeg % 360 < 360 && startDeg % 360 > 270 && endDeg % 360 > 0 && endDeg % 360 < 90) {
            
            document.getElementById("winner").innerHTML = items[i].offer;
        }
    }
}

let speed = 0;
let maxRotation = randomRange(360 * 3, 360 * 6);
let pause = false;

function animate() {
    if (pause) return;

    speed = easeOutSine(getPercent(currentDeg, maxRotation, 0)) * 20;
    if (speed < 0.01) {
        speed = 0;
        pause = true;

        // determineWinner()
    }
    currentDeg += speed;
    draw();
    window.requestAnimationFrame(animate);
}

function spin() {
    if (speed !== 0) return;

    currentDeg = 0;
    maxRotation = randomRange(360 * 3, 360 * 6);
    pause = false;
    window.requestAnimationFrame(animate);
}

function determineWinner() {
    // Calculate the final angle within 0 to 360 degrees
    const finalAngle = currentDeg % 360;

    // Find the segment that contains the finalAngle
    for (let i = 0; i < items.length; i++) {
        const startDeg = itemDegs[items[i]].startDeg % 360;
        const endDeg = itemDegs[items[i]].endDeg % 360;

        // Handle wraparound cases where segments cross the 0-degree line
        if ((startDeg < endDeg && finalAngle >= startDeg && finalAngle < endDeg) ||
            (startDeg > endDeg && (finalAngle >= startDeg || finalAngle < endDeg))) {
            // Display the winner
            document.getElementById("winner").innerHTML = `Winner: ${items[i].offer}`;
            console.log("Winner:", items[i].offer);
            break;
        }
    }
}


    </script>
</body>

</html>
