<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "robot";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the JSON payload was sent
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON);

if ($input && isset($input->speed)) {
    // Retrieve the speed value from the JSON payload
    $speed = $input->speed;

    // Insert the speed value into the database
    $sql = "INSERT INTO car_speed (speed) VALUES ($speed)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Speed updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating speed: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Invalid data received"]);
}

// Close the database connection
$conn->close();
?>
