<!DOCTYPE html>
<html>

<head>
	<title>Page Title</title>
	<meta http-equiv="refresh" content="10">
</head>

<body>
	<h2>Welcome To GFG</h2>
	<p>The code will reload after 10s.</p>
</body>

</html>

<?php
include_once("vendor/autoload.php");
use Yvesniyo\IntouchSms\SmsSimple;

$servername = "localhost";
$username = "rwanxypu_meter1";
$password = "[1gis*gv^0Tf";
$dbname = "rwanxypu_meter";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentTime = date("H:i");
$sql = "SELECT * FROM umaze_gukoreshwa ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $device1 = (int) $row['ma1'];
    $device2 = (int) $row['umaze_gukoreshwa'];
    $phone = (int)$row['phone'];
    
   
$nimero = "0" . $phone;
echo $device2;


    if ($device1 <=1) {
        $sms = new SmsSimple();
        $sms->recipients(["0789223296"])
            ->message("Load 1 disconnected")
            ->sender("0783159293")
            ->username("Dushime")
            ->password("dushime1")
            ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
            ->callBackUrl("");

        // Sending SMS and checking for success
        $smsResult = $sms->send();

        if ($smsResult) {
            echo "SMS sent successfully: Load 1 disconnected";
        } else {
            echo "SMS sending failed: Load 1 disconnected";
        }
    } else {
        echo "Load 1 is connected";
    }

    if ($device2<=2) {
        $sms = new SmsSimple();
        $sms->recipients(["0789570338"])
            ->message("Your Energy is about to finish")
            ->sender("+250783159293")
            ->username("Dushime")
            ->password("dushime1")
            ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
            ->callBackUrl("");
 echo "Your Energy is finished";
        // Sending SMS and checking for success
        $smsResult = $sms->send();

        if ($smsResult) {
            echo "SMS sent successfully: Load 2 disconnected";
        } else {
            echo "SMS sending failed: Load 2 disconnected";
        }
    } else {
        echo "Load 2 is connected";
    }
} else {
    echo "No tasks found for the current time.";
    echo $currentTime; // Make sure $currentTime is defined
}

// Close the database connection
$conn->close();
?>
