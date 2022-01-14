<?php 
#include('uploadpost.php'); 
include('connection.php'); 
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post page</title>
</head>

<body>
<h1>this is Create post page</h1>

<?php  
   $query = "SELECT * FROM `post` WHERE `POST_ID`='17'";  
   $results = mysqli_query($conn, $query); //return object
	if (mysqli_num_rows($results) == 1) { //if there is something in the result
        $data=mysqli_fetch_assoc($results);} //array

echo '<img src="data:image/jpeg;base64,'.base64_encode($data['POST_PICTURE'] ).'" height="200" width="200"/>  '

?>
<!--
<?php 
$result = $conn->query("SELECT 'POST_PICTURE' FROM `post` ORDER BY id DESC"); 
?>

<?php if(mysqli_num_rows($results) > 0){ ?> 
        <?php while($row = mysqli_fetch_assoc($results)){ ?> 
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['POST_PICTURE']); ?>" /> 
        <?php } ?> 
 <?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>-->


<form action="uploadpost.php" method="post" >

<input type="text"  name="itemname" placeholder="Item name">
<textarea placeholder="Description"  name="itemdescription"></textarea>
<input type="file" name="itemimage">
<input type="text"name="itemquantity" placeholder="Quantity">
<select name="itemcategory">
    <option >Food</option>
    <option >Non-Food</option>
</select>
<input type="text"name="itemlocation" placeholder="Location">


<button type="submit" name="insert">Create Post</button>

</form>

</form>

</body>
</html>