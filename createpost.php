<?php 
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
   $query = "SELECT * FROM `post` WHERE `POST_ID`='27'";  
   $results = mysqli_query($conn, $query); 
	if (mysqli_num_rows($results) == 1) { 
        $data=mysqli_fetch_assoc($results);} 

echo '<img src="data:image/jpeg;base64,'.base64_encode($data['POST_PICTURE'] ).'" height="200" width="200"/> '
?>

<!--FORM HERE-->

<form action="uploadpost.php" method="post" enctype="multipart/form-data">

<input type="text"  name="itemname" placeholder="Item name">
<textarea placeholder="Description"  name="itemdescription"></textarea>
<input type="file" name="itemimage">
<input type="number"name="itemquantity" placeholder="Quantity">
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