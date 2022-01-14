<?php

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

//test insert into DB
//if jadi, then try to retrieve image - maybe can get code from Aliff
/*$query = "INSERT INTO post
(POST_ID, USER_ID, POST_ITEM_NAME, POST_DESCRIPTION,POST_PICTURE,POST_QUANTITY
POST_LOCATION,POST_CATEGORY,POST_DATE,POST_TIME)
VALUES
(NULL,'3','TOMYAM','dDesc',NULL,'1','emlocation','FOOD','2022-01-13','19:17:23')";*/
/*
$query =
"INSERT INTO `post` (`POST_ID`, `USER_ID`, `POST_ITEM_NAME`, `POST_DESCRIPTION`, `POST_PICTURE`, `POST_QUANTITY`, 
`POST_LOCATION`, `POST_CATEGORY`, `POST_DATE`, `POST_TIME`) 
VALUES (NULL, '1', 'Nasi bujang', 'Nasi bujang forever',NULL , '2', 'Cafe CGH', 'FOOD', '2022-01-13', '19:17:23')";*/

if (isset($_POST['insert'])) {

#Get all input from FORM
#$file = addslashes(file_get_contents($_FILES["itemimage"]["tmp_name"]));//get file


/*
$check = getimagesize($_FILES["itemimage"]["tmp_name"]);
echo $check;
if($check !== false){
    $image = $_FILES['itemimage']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));}
    else{
        echo "Please select an image file to upload.";}*/



$file = $_FILES['itemimage']['tmp_name'];
$check = getimagesize($file);
echo $check;
$itemname = $_REQUEST['itemname'];
$itemdescription= $_REQUEST['itemdescription'];
$itemquantity = $_REQUEST['itemquantity'];
$itemlocation = $_REQUEST['itemlocation'];
$itemcategory = $_REQUEST['itemcategory'];
$date = date("Y\-m\-d");
$time = date("H:i:s");

$query = "INSERT INTO `post` (`POST_ID`, `USER_ID`, `POST_ITEM_NAME`, `POST_DESCRIPTION`, `POST_PICTURE`, `POST_QUANTITY`, 
`POST_LOCATION`, `POST_CATEGORY`, `POST_DATE`, `POST_TIME`) 
VALUES (NULL, '1', '$itemname', '$itemdescription','$image' , '$itemquantity', 
'$itemlocation', '$itemcategory', '$date', '$time')";

if(mysqli_query($conn,$query))
{print("Stored");} 
else {
    print("Failed");
}
}
echo "<script>location.href='createpost.php'</script>";
/*
#Get all input from FORM
$file = addslashes(file_get_contents($_FILES["itempicture"]["tmp_name"]));//get file
$itemname = $_REQUEST['itemname'];
$itemdescription= $_REQUEST['itemdescription'];
$itemquantity = $_REQUEST['itemquantity'];
$itemlocation = $_REQUEST['itemlocation'];
$itemcategory = $_REQUEST['itemcategory'];
$date = date("Y\-m\-d");
$time = date("H:i:s");


if(isset($_POST["insert"])){
    $query = "INSERT INTO post VALUES 
    ($itemname,$itemdescription,$file,$itemquantity,$itemlocation,$itemcategory)";

}
*/

?>
