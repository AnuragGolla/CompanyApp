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


$checkingUserEmail = $_POST['addedMember'];

$checkVar = "SELECT * FROM googleUsers WHERE email = $checkingUserEmail;";

if ($result = mysqli_query($conn, $checkVar)){
  $numRows = mysqli_num_rows($result);
  if ($numRows > 0){
    echo "Found $checkingUserEmail";
  } else {
    echo "not working";
  }
}

mysqli_close($conn);
?>
