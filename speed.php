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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $direction = $_POST["direction"];
    
    // Insert the form data into the database
    $sql = "INSERT INTO direction (direction) VALUES ('$direction')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo json_encode(["error" => "Error inserting data: " . $conn->error]);
    }
}

// Close the database connection
$conn->close();
?>
