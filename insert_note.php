<?php
require_once 'server.php'; //connect DB
//PREVIOUS PROJECT

//Get the values from FORM
$category = $_REQUEST['cat'];
$title = $_REQUEST['title'];
$text = $_REQUEST['text'];
$date = date("Y\-m\-d");

$category = $_REQUEST['cat'];
$title = $_REQUEST['title'];
$text = $_REQUEST['text'];
$date = date("Y\-m\-d");

// insert data to db

/*$sql = "INSERT INTO notes (note_category, note_title, note_text, note_date) VALUES
        (
        '$category',
        '$title',
        '$text',
        '$date'
       )";*/

if(mysqli_query($link,$sql)){
    print("Stored");
} else {
    print("Failed");
}

// redirect to main page
echo "<script>location.href='index.php'</script>";

?>