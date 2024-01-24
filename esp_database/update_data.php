<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart-ac";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch the latest data
function fetchLatestData($conn) {
    $sql = "SELECT data_sensor, status FROM data ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return false;
    }
}
 
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// Function to send updates
function sendUpdate($data) {
    echo "data: " . json_encode($data) . "\n\n";
    ob_flush();
    flush();
}

while (true) {
    $latestData = fetchLatestData($conn);
    if ($latestData) {
        sendUpdate($latestData);
    }
    sleep(5); // Tunggu selama 5 detik sebelum mengirim update berikutnya
}
?>

