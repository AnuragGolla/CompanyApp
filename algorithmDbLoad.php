<?php
$servername = "localhost";
$username = "root";
$password = "xampp15";
$dbname = "synkeio_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
    echo "Connection success<br>";
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    //echo "Connection failed echo";
}

$thisName = "";
if (isset($_POST['gName']))
{
  $thisName = $_POST["gName"];
}
$thisName = $_POST["gName"];



$groupsListQ = "SELECT DISTINCT userEmail
FROM synkeioGroups
WHERE groupName = '$thisName';";

$request = mysqli_query($conn, $groupsListQ);

$listedUserEvents = array();

while ($row = mysqli_fetch_assoc($request)) {
  //echo ($row["userEmail"]) . "<br>";
  $thisEmail = $row["userEmail"];

  $innerRequest = "SELECT googleEvents
  FROM googleUsers
  WHERE email = '$thisEmail';";

  $eventString = mysqli_query($conn, $innerRequest);
  $eventStringMod = mysqli_fetch_assoc($eventString);

  $listedUserEvents[] = $eventStringMod["googleEvents"];

}

//can use $listedUserEvents string as the output of array of strings of all users in the entered group


mysqli_close($conn);
?>
