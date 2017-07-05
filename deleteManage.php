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


$sql = "DELETE FROM googleUsers";

//$sql = "DELETE FROM googleUsers WHERE ID = 0 OR fullName = null OR ID =123 OR ID = 124 ;";



if (mysqli_query($conn, $sql)) {
    echo "Deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
