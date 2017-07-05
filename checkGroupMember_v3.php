<?php
$servername = "localhost";
$username = "root";
$password = "xampp15";
$dbname = "synkeio_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$enterGroupName = $_REQUEST['groupName'];
$enterMemberEmail = $_REQUEST['addedMember'];

echo "Group Name: " . $enterGroupName;
echo "<br>Member Email: " . $enterMemberEmail;

$addMemberQuery = "INSERT INTO synkeioGroups (groupName, userEmail)
VALUES ('$enterGroupName', '$enterMemberEmail');";
/*WHERE EXISTS (SELECT *
FROM googleUsers
WHERE email = $enterMemberEmail);";*/

$result = mysqli_query($conn, $addMemberQuery);
echo "<br>result= " . $result;

/*
$showGroup = "SELECT (email)
FROM synkeioGroups"
*/

mysqli_close($conn);
?>
