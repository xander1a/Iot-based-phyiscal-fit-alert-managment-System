<head>
  <meta http-equiv="refresh" content="30">
</head>
<?php
include_once("vendor/autoload.php");
use Yvesniyo\IntouchSms\SmsSimple;

$servername = "localhost";
$username = "rwanxypu_fit";
$password = "WJqVqL=&g?%b";
$dbname = "rwanxypu_fit";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$phone = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
$phoneResult = $conn->query($phone);
$phoneOk = $phoneResult->fetch_assoc();
echo $phoneOk['phone'];
$number= $phoneOk['phone'];

date_default_timezone_set('Africa/Kigali');
// Get the current time with hours and minutes only
$currentTime = date("H:i");

// Query to retrieve tasks with times that match the current time
$sql = "SELECT * FROM task WHERE TIME_FORMAT(set_time, '%H:%i') = '$currentTime'";
$result = $conn->query($sql);

// Check if there are tasks for the current time
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $taskName = $row['task'];

        $sms = new SmsSimple();
        $sms->recipients([$number])
            ->message("Its time for task")
            ->sender("+250783159293")
            ->username("Dushime")
            ->password("dushime1")
            ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
            ->callBackUrl("");
              print_r($sms->send());

        try {
            $smsResult =  print_r($sms->send());
            if ($smsResult) {
                echo "SMS sent successfully for task: $taskName";
            } else {
                echo "SMS sending failed for task: $taskName";
            }
        }
         catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "No tasks found for the current time.";
    echo $currentTime;
}

// Close the database connection
$conn->close();
?>
