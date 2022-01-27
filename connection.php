<!--Universal file connect to DB-->
<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "Rizqi";
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
/*if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo nl2br("\nConnected successfully to " . $db . " database.\n");*/

?>