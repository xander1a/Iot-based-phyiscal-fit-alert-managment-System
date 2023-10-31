<?php
session_start();

if (isset($_GET['user_id'])) {
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

    $deleteUser_id = $_GET['user_id'];

    // You should add further validation and security checks here, such as ensuring the user has permission to delete this record.

    // SQL query to delete the user
    $deleteQuery = "DELETE FROM user WHERE id = '$deleteUser_id'";

    if ($conn->query($deleteQuery) === TRUE) {
        // Deletion successful, you can redirect or display a success message
        header("Location: Setting.php"); // Redirect to the dashboard or any other page
        exit();
    } else {
        echo "Error: " . $deleteQuery . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>