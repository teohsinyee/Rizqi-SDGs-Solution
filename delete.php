<?php

include('connection.php');  

$postid = $_GET['id']; 

$query = "DELETE FROM `post` WHERE `post`.`POST_ID` = '$postid'";

  if ($conn->query($query) === TRUE) {
   echo "Record DELETED successfully";
   header("location:profileinfo.php");
   exit;
 } else {
   echo "Error DELETING record: " . $conn->error;
 }

?>


