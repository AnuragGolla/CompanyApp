<?php
$servername = "localhost";
$username = "root";
$password = "xampp15";
$dbname = "synkeio_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
    //echo "Connection success<br>";
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    //echo "Connection failed echo";
}

$eName = "";
if (isset($_POST['eName']))
{
  $eName = $_POST["eName"];
}
$eName = $_POST["eName"];

$userInput = "SELECT *
FROM synkeioEvents
WHERE EventName = '$eName';";

$request = mysqli_query($conn, $userInput);
$requestMod = mysqli_fetch_assoc($request);

$eventName = $requestMod["EventName"];
$groupName = $requestMod["GroupName"];
$eventStartDate = $requestMod["StartDate"];
$eventEndDate = $requestMod["EndDate"];
$eventStartTime = $requestMod["StartTime"];
$eventEndTime = $requestMod["EndTime"];
$location = $requestMod["Location"];
$meetingLength = $requestMod["meetingTime"];

//echo $eventName . $groupName . $eventStartDate . $eventEndDate . $eventStartTime . $eventEndTime . $location . $meetingLength;

mysqli_close($conn);
?>
