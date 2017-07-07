<?php
$servername = "localhost";
$username = "root";
$password = "xampp15";
$dbname = "synkeio_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
    //echo "Connection success";
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    //echo "Connection failed echo";
}

$groupsListQ = "SELECT groupName
FROM synkeioGroups
WHERE userEmail = $thisEmail;";








mysqli_close($conn);
?>
