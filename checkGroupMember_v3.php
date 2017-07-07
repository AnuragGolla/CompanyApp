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

  include 'groupCreationForm_v3.html';
  echo "<div id='phpsqlSection'>";


  $enterGroupName = $_REQUEST['groupName'];
  $enterMemberEmail = $_REQUEST['addedMember'];

  //echo "Group Name: " . $enterGroupName;
  //echo "<br>Member Email: " . $enterMemberEmail;


  $checkMember = "SELECT *
  FROM googleUsers
  WHERE email = '$enterMemberEmail';";


  $queryObject = mysqli_query($conn, $checkMember);

  $num_rows = mysqli_num_rows($queryObject);
  var_dump($num_rows);

  //echo "Rows: $num_rows";

  $addActivity = "INSERT INTO synkeioGroups (groupName, userEmail)
  VALUES ('$enterGroupName', '$enterMemberEmail');";

  if ($enterGroupName =="") {
    echo "Please enter the group name to view the group and add a Synke.io member email to add the member to the group.";
  } elseif ($enterMemberEmail=="" && $enterGroupName !=="") {
    echo "";
  } elseif ($num_rows > 0) {
    mysqli_query($conn, $addActivity);
  } else {
    echo "<br>Error: This email address is not a registered Synke.io user. Please try again.";
  }


  /*if ($num_rows > 0) {
    mysqli_query($conn, $addActivity);
    //include 'groupCreationForm_v3.html';
  } else {
    echo "<br>Error: This email address is not a registered Synke.io user. Please try again.";
  }*/

  $sql = "SELECT DISTINCT userEmail
  FROM synkeioGroups
  WHERE groupName = '$enterGroupName';";

  $userList = mysqli_query($conn, $sql);

  //var_dump($userList);
  //echo "<br>" . $userList["current_field"];

  echo "<h3>Group Members: </h3><br>";

  while ($row = mysqli_fetch_assoc($userList)) {
    //echo ($row["userEmail"]) . "<br>";
    $e = $row["userEmail"];

    $nameSelector = "SELECT fullName
    FROM googleUsers
    WHERE email = '$e';";

    $a = mysqli_query($conn, $nameSelector);
    //var_dump($a);
    //var_dump($a["current_field"]);
    $b = mysqli_fetch_assoc($a);
    //var_dump($b);
    //echo ($b["fullName"]);
    echo "<div class='newUser'>";
    echo $b["fullName"];
    echo "</div>";
  }

  echo "</div></div>";

mysqli_close($conn);



//  $theList = mysql_fetch_assoc("$userList");

/*
  while($row = mysqli_fetch_assoc($resultado))
  {
      print_r($row);
      // Or print any specific column like:
      echo $row['col_name'];
  }
*/



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


?>
