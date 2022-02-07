<!--Universal file connect to DB-->
<?php

$servername = "us-cdbr-east-05.cleardb.net";
$username = "bea65a9aaea3de";
$password = "3b99e784";
$db = "heroku_f1d328fd0c6533b";
$conn = mysqli_connect($servername, $username, $password,$db);

/*deprecated
$servername = "localhost";
$username = "root";
$password = "";
$db = "Rizqi";
$conn = mysqli_connect($servername, $username, $password,$db);*/

// Check connection
/*if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo nl2br("\nConnected successfully to " . $db . " database.\n");*/

?>