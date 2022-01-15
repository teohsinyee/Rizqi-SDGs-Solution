<?php 
include('connection.php'); 
session_start();

$_SESSION['userid'] = 1;
$id = $_SESSION['userid'];

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile details</title>
</head>

<body>
<h1>My Profile details</h1>

<div>
    <h2>Here is the user profile details</h2>
<?php  
   $query = "SELECT * FROM `user` WHERE `USER_ID`='$id'";  
   $results = mysqli_query($conn, $query);
	if (mysqli_num_rows($results) == 1) { 
        $data=mysqli_fetch_assoc($results);} 
echo $data['USER_NAME'] . " ".$data['USER_EMAIL']. " ".$data['USER_PHONE_NUMBER'];
?>
</div>

<!--A form enable to user to update the quantity
0. DELETE FROM `post` WHERE `post`.`POST_ID` = 18"
1. UPDATE `post` SET `POST_QUANTITY` = '3' WHERE `post`.`POST_ID` = 2
2. POST_QUANTITY shud be dynamic & take user input
Extra: Field validation - becuz if user keyin string then it will cause error when insert
input into SQL statement
-->
<!--Make a listings table here -->

<div>
    <h2>My Listings</h2>
    <table border="2">
  <tr>
    <td>Item ID</td>
    <td>Item name</td>
    <td>Item description</td>
    <td>Item quantity</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>

  <?php  
  $query = "SELECT * FROM `POST` WHERE `USER_ID`='$id'";  
  $results = mysqli_query($conn, $query); 
  while($data = mysqli_fetch_array($results))
{
?>
<tr>
    <td><?php echo $data['POST_ID']; ?></td>
    <td><?php echo $data['POST_ITEM_NAME']; ?></td>
    <td><?php echo $data['POST_DESCRIPTION']; ?></td>
    <td><?php echo $data['POST_QUANTITY']; ?></td>    
    <td><a href="edit.php?id=<?php echo $data['POST_ID']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $data['POST_ID']; ?>">Delete</a></td>
  </tr>
  <?php
}
?>
</table>

</div>

</body>
</html>