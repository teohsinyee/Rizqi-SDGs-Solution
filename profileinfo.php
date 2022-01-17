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
<!--USER IMAGE!-->
<?php  
   $query = "SELECT * FROM `user` WHERE `USER_ID`='$id'";  
   $results = mysqli_query($conn, $query);
	if (mysqli_num_rows($results) == 1) { 
        $data=mysqli_fetch_assoc($results);} 
echo $data['USER_NAME'] . " ".$data['USER_EMAIL']. " ".$data['USER_PHONE_NUMBER']. " ".
'<img src="data:image/jpeg;base64,'.base64_encode($data['USER_PICTURE'] ).'" height="200" width="200"/> ';
?>
</div>

<!--Make a listings table here -->
<!--ITEM IMAGE!-->
<div>
    <h2>My Active Listings</h2>
    <table border="2">
  <tr>
    <td>Item ID</td>
    <td>Item name</td>
    <td>Item description</td>
    <td>Item quantity</td>
    <td>Item picture</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>

  <?php  
  $query = "SELECT * FROM `POST` WHERE `USER_ID`='$id'";  
  $results = mysqli_query($conn, $query); 
  while($data = mysqli_fetch_array($results))
{
  if($data['POST_QUANTITY']>0){ //Only show quantity >0
?>
<tr>
    <td><?php echo $data['POST_ID']; ?></td>
    <td><?php echo $data['POST_ITEM_NAME']; ?></td>
    <td><?php echo $data['POST_DESCRIPTION']; ?></td>
    <td><?php echo $data['POST_QUANTITY']; ?></td>
    <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($data['POST_PICTURE'] ).'" height="200" width="200"/>';?> </td>    
    <td><a href="edit.php?id=<?php echo $data['POST_ID']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $data['POST_ID']; ?>">Delete</a></td>
  </tr>
  <?php
}
?>
  <?php
}
?>
</table>

</div>

</body>
</html>