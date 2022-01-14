<?php 
include('connection.php'); 
session_start();
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

<!--display name,email,phone number
1. select display specific user
2. USER_ID should be dynamic based on the login session ID - derived USER_ID from email
3. ASSIGN SESSION[USER_ID]=USER_ID.....
4. The query should be..... USER_ID = $SESSION['USER_ID'].....
-->
<div>
    <h2>Here is the user profile details</h2>
<?php  
   $query = "SELECT * FROM `user` WHERE `USER_ID`='2'";  
   $results = mysqli_query($conn, $query); //return object
	if (mysqli_num_rows($results) == 1) { //if there is something in the result
        $data=mysqli_fetch_assoc($results);} //array
echo $data['USER_NAME'] . " ".$data['USER_EMAIL']. " ".$data['USER_PHONE_NUMBER'];
?>
</div>

<!--Show post id that link to this user
1. select from post DB & where user_ID = '''''
-->
<div>
    <h2>Here is the listing</h2>
<?php  
   $query = "SELECT * FROM `POST` WHERE `USER_ID`='4'";  #need to make a loop here
   $results = mysqli_query($conn, $query); //return object
	if (mysqli_num_rows($results) == 1) { //if there is something in the result
        $data=mysqli_fetch_assoc($results);} //array
echo $data['POST_ITEM_NAME'] . " ".$data['POST_DESCRIPTION']. " ".$data['POST_QUANTITY']. " ".$data['POST_PICTURE'];
?>
<!--A form enable to user to update the quantity
0. DELETE FROM `post` WHERE `post`.`POST_ID` = 18"
1. UPDATE `post` SET `POST_QUANTITY` = '3' WHERE `post`.`POST_ID` = 2
2. POST_QUANTITY shud be dynamic & take user input
Extra: Field validation - becuz if user keyin string then it will cause error when insert
input into SQL statement
3. https://stackoverflow.com/questions/13882656/html-form-in-php-while-loop
-->

</div>
</body>
</html>