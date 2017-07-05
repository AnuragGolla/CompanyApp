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
echo "Connected successfully";


$userDbId = 0;
$userDbFullName = "";
$userDbGivenName = "";
$userDbFamilyName = "";
$userDbEmail = "";


if (isset($_POST['user_Id']))
{
  $userDbId = $_POST["user_Id"];
}

if (isset($_POST['user_FullName']))
{
  $userDbFullName = $_POST["user_FullName"];
}

if (isset($_POST['user_GivenName']))
{
  $userDbGivenName = $_POST["user_GivenName"];
}

if (isset($_POST['user_FamilyName']))
{
  $userDbFamilyName = $_POST["user_FamilyName"];
}

if (isset($_POST['user_Email']))
{
  $userDbEmail = $_POST["user_Email"];
}

$userDbId = $_POST["user_Id"];
$userDbFullName = $_POST["user_FullName"];
$userDbGivenName = $_POST["user_GivenName"];
$userDbFamilyName = $_POST["user_FamilyName"];
$userDbEmail = $_POST["user_Email"];


$profileData = "INSERT INTO googleUsers (ID, fullName, givenName, lastName, email)
VALUES ('$userDbId', '$userDbFullName', '$userDbGivenName', '$userDbFamilyName', '$userDbEmail');";


if (mysqli_query($conn, $profileData)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $profileData . "<br>" . mysqli_error($conn);
}

?>
