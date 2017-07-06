<?php
$servername = "localhost";
$username = "root";
$password = "xampp15";
$dbname = "synkeio_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
    echo "Connection success echo";
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Connection failed echo";
}


/*
//check if this is the best initialization
$dbEventName = "";
$dbGroupName = "";
$dbStartDate = "";
$dbEndDate = "";
$dbStartTime = "";
$dbEndTime = "";
$dbLocation = "";


if (isset($_POST['event_Name']))
{
  $dbEventName = $_POST["event_Name"];
}

if (isset($_POST['group_Name']))
{
  $dbGroupName = $_POST["group_Name"];
}

if (isset($_POST['event_Start_Date']))
{
  $dbStartDate = $_POST["event_Start_Date"];
}

if (isset($_POST['event_End_Date']))
{
  $dbEndDate = $_POST["event_End_Date"];
}

if (isset($_POST['event_Start_Time']))
{
  $dbStartTime = $_POST["event_Start_Time"];
}

if (isset($_POST['event_End_Time']))
{
  $dbEndTime = $_POST["event_End_Time"];
}

if (isset($_POST['loca_tion']))
{
  $dbLocation = $_POST["loca_tion"];
}
*/

/*
  $dbEventName = $_POST["event_Name"];
  $dbGroupName = $_POST["group_Name"];
  $dbStartDate = $_POST["event_Start_Date"];
  $dbEndDate = $_POST["event_End_Date"];
  $dbStartTime = $_POST["event_Start_Time"];
  $dbEndTime = $_POST["event_End_Time"];
  $dbLocation = $_POST["loca_Tion"];
  $dbMeetingTime = $_POST["meeting_Length"];
*/

$dbEventName = "sampleEvent";
$dbGroupName = "testy";
$dbStartDate = "07/08/17";
$dbEndDate = "07/15/17";
$dbStartTime = "12:00:PM";
$dbEndTime = "05:00:PM";
$dbLocation = "Boulder";
$dbMeetingTime = 120;


  echo "<script>console.log($dbEventName)</script>";



$eventData = "INSERT INTO synkeioEvents (GroupName, EventName, StartDate, EndDate, StartTime, EndTime, Location, meetingTime)
VALUES ('$dbGroupName', '$dbEventName', '$dbStartDate', '$dbEndDate', '$dbStartTime', '$dbEndTime', '$dbLocation', '$dbMeetingTime');";

$checker = "SELECT *
FROM synkeioGroups
WHERE groupName = $dbGroupName;";

$query = mysqli_query($conn, $checker);

$numRows = mysqli_num_rows($query);

if ($numRows > 0) {
  mysqli_query($conn, $eventData);
  echo "Success!";
} else {
  include 'eventCreate.html';
  echo "Error: The Group Name that you entered does not exist. Please try again.";
}


mysqli_close($conn);
?>
