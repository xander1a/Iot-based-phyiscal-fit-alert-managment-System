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

if ($input && isset($input->direction)) {
    // Retrieve the direction value from the JSON payload
    $direction = $input->direction;

    // Insert the direction value into the database
    $sql = "INSERT INTO car_controls (direction) VALUES ('$direction')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Direction updated successfully"]);
        
    } else {
        echo json_encode(["error" => "Error updating direction: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Invalid data received"]);
}

// Close the database connection
$conn->close();
?>
