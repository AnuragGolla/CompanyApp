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

//echo "Group Name: " . $enterGroupName;
//echo "<br>Member Email: " . $enterMemberEmail;


$checkMember = "SELECT *
FROM googleUsers
WHERE email = '$enterMemberEmail';";


$queryObject = mysqli_query($conn, $checkMember);

$num_rows = mysqli_num_rows($queryObject);

//echo "Rows: $num_rows";


$addActivity = "INSERT INTO synkeioGroups (groupName, userEmail)
VALUES ('$enterGroupName', '$enterMemberEmail');";


if ($num_rows > 0) {
  mysqli_query($conn, $addActivity);
  include 'groupCreationForm_v3.html';
} else {
  echo "<br>Error: This email address is not a registered Synke.io user. Please try again.";
}


/*
$queryNum = mysqli_fetch_assoc($queryObject);

echo "<br>" . $queryNum[0];

$queryInt = (int)$queryNum;

echo "<br>" . $queryInt;
*/









/*
$addMemberQuery = "INSERT INTO synkeioGroups (groupName, userEmail)
VALUES ('$enterGroupName', '$enterMemberEmail');";*/
/*WHERE EXISTS (SELECT *
FROM googleUsers
WHERE email = $enterMemberEmail);";*/

/*
$checkMember = "SELECT COUNT(*)
FROM googleUsers
WHERE email = '$enterMemberEmail';";

echo "<br>" . $checkMember;

$queryObject = mysqli_query($conn, $checkMember);

//echo "<br>" . $queryObject;

$queryNum = mysqli_fetch_assoc($queryObject);

echo "<br>" . $queryNum[0];

$queryInt = (int)$queryNum;

echo "<br>" . $queryInt;
*/

/*
if (mysqli_query($conn, $checkMember) > 0) {
  echo "<br>yay";
} else {
  echo "<br>nooo";
}
*/

//$testResult = mysqli_query($conn, $sql);

/*
if (mysqli_query($conn, $checkMember)) {
    echo "<br>Query successful";
} else {
    echo "<br>Error.";
}
*/

/*
$result = mysqli_query($conn, $addMemberQuery);
echo "<br>result= " . $result;
*/

/*
$showGroup = "SELECT (email)
FROM synkeioGroups"
*/

mysqli_close($conn);
?>
