<?php
// Start a session
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Database connection settings (modify these)
    // $hostname = 'localhost'; // Replace with your database hostname
    // $username = 'root'; // Replace with your database username
    // $password = ''; // Replace with your database password
    // $database = 'heart'; // Replace with your database name


    $servername = "localhost";
$username = "rwanxypu_fit";
$password = "WJqVqL=&g?%b";
$dbname = "rwanxypu_fit";
    // Create a database connection
    $conn = new mysqli( $servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from the form
    $place = $_POST['place'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Prepare and execute the SQL query to insert the data into the database
    $sql = "INSERT INTO task (task, set_time, date) VALUES ('$place', '$time', '$date')";

    if ($conn->query($sql) === TRUE) {
        // Set a success message in the session
       // $_SESSION['message'] = "Event registered successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Form not submitted";
}

// Redirect back to the previous page or wherever needed
 header("Location: dashboard.php"); // Replace 'dashboard.php' with the actual URL of the page you want to return to
 exit();
?>
