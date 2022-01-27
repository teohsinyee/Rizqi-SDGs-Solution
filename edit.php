<!--DEPRECATED 
MIGRATED TO Profileinfo.php line 95-->
<?php

include('connection.php');  

$_SESSION['userid'] = 1;

/*
when click

*/

$id = $_GET['id']; 


if($id == NULL){
    echo'FAILED BECAUSE NOT SUBMIT SELECT POST YET';
    header("location:profileinfo.php");
}
else{

$qry = mysqli_query($conn,"SELECT * FROM `POST` where 'POST_ID'='$id'"); // select query

$data = mysqli_fetch_array($qry); 

if(isset($_POST['update'])) // when click on Update button
{
    $quantity = $_POST['quantity'];

    $query = "UPDATE `post` SET `POST_QUANTITY` = '$quantity' WHERE `post`.`POST_ID` = '$id'";  
  if ($conn->query($query) === TRUE) {
   echo "Record updated successfully";
   header("location:profileinfo.php");
 } else {
   echo "Error updating record: " . $conn->error;
 }

}
}
?>

<h3>Update Data</h3>

<form method="POST">
  <input type="number" name="quantity" value="<?php echo $data['POST_QUANTITY'] ?>" placeholder="Enter Quantity" Required>
  <input type="submit" name="update" value="Update">
</form>