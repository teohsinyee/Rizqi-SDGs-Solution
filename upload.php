<?php
//JUST A REFERENCE - NOT IMPLEMENT THIS
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "Rizqi";
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo nl2br("\nConnected successfully to " . $db . " database.\n\n\n");


if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

      /*
       * Insert image data into database
       */

      //DB details
      $dbHost     = 'localhost';
      $dbUsername = 'root';
      $dbPassword = '*****';
      $dbName     = 'codexworld';

      //Create connection and select DB
      $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

      // Check connection
      if($db->connect_error){
          die("Connection failed: " . $db->connect_error);
      }

      $dataTime = date("Y-m-d H:i:s");

      //Insert image content into database
      $insert = $db->query("INSERT into images (image, created) VALUES ('$imgContent', '$dataTime')");
      if($insert){
          echo "File uploaded successfully.";
      }else{
          echo "File upload failed, please try again.";
      } 
  }else{
      echo "Please select an image file to upload.";
  }
}
?>