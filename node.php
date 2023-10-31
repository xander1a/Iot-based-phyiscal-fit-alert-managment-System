<?php

$servername = "localhost";
$username = "rwanxypu_fit";
$password = "WJqVqL=&g?%b";
$dbname = "rwanxypu_fit";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the response array
$response = array();
$receivedData = file_get_contents('php://input');
file_put_contents('received_data.log', $receivedData);

// Decode the received JSON data into a PHP array
$data = json_decode($receivedData, true);

  date_default_timezone_set('Africa/Kigali');
//$currentDate = date("Y-m-d H:i:s"); // Get the current date and time in "YYYY-MM-DD HH:MM:SS" format for the Rwanda time zone

// Check if the request is a POST request and if it contains JSON data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($receivedData)) {
    if (isset($data['sendval']) && isset($data['sendval2']) && isset($data['sendval3'])) {
        $val2 = (int)$data['sendval'];
        $val3 = (int)$data['sendval2'];
        $val4 = (int)$data['sendval3'];
        
        $currentDate = date("Y-m-d H:i:s"); // Get the current date and time in "YYYY-MM-DD HH:MM:SS" format

        try {
            $sql = "INSERT INTO nodemcu (bitrate, oxgen, code, date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                throw new Exception("Error preparing the SQL statement: " . $conn->error);
            }

            $stmt->bind_param('iiis', $val2, $val3, $val4, $currentDate);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Data inserted successfully.";
            } else {
                $response['success'] = false;
                $response['message'] = "Error inserting data: " . $conn->error;
            }
        } catch (Exception $e) {
            $response['success'] = false;
            $response['message'] = "Database error: " . $e->getMessage();
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Missing keys 'sendval', 'sendval2', or 'sendval3' in JSON data.";
    }
} else {
 
    $response['success'] =  $currentDate;
    $response['message'] = "Invalid request or missing JSON data.";
}

// Close the database connection (assuming you have an active database connection)
$conn->close();
//echo $currentDate;
// Return a JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
