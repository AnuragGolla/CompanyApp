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





$profileData = "INSERT INTO googleUsers (ID, fullName, givenName, lastName, email)
VALUES ('$userDbId', '$userDbFullName', '$userDbGivenName', '$userDbFamilyName', '$userDbEmail');";


if (mysqli_query($conn, $profileData)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $profileData . "<br>" . mysqli_error($conn);
}

?>
