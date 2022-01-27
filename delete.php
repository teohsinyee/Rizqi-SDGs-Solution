<?php

include('connection.php');  

$id = $_GET['id']; 

$query = "DELETE FROM `post` WHERE `post`.`POST_ID` = '$id'";

  if ($conn->query($query) === TRUE) {
   echo "Record DELETED successfully";
   header("location:profileinfo.php");
   exit;
 } else {
   echo "Error DELETING record: " . $conn->error;
 }

?>


