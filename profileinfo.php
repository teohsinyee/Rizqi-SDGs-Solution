<?php 
include('connection.php'); 
session_start();

$_SESSION['userid'] = 1;
$id = $_SESSION['userid'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
		<title>My Profile</title>
		<link rel="icon" type="image/x-icon" href="https://64.media.tumblr.com/34d27d0e919fd4a61946def0c6659b63/tumblr_inline_mgfxr4hoqm1roozkr.gif">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>

<body class="is-preload">
		<div id="page-wrapper">
			<!-- Header -->
				<header id="header">

					<nav id="nav">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="post.html">Post</a></li>
							<li><a href="profileinfo.php">My Profile</a></li>
							<li><a href="logout.php" class="button">Logout</a></li>
						</ul>
					</nav>
				</header>	

<!-- Main -->
<section id="main" class="container">
				<section class="box special">
					
        <!--user profile-->
<?php  
   $query = "SELECT * FROM `user` WHERE `USER_ID`='$id'";  
   $results = mysqli_query($conn, $query);
	if (mysqli_num_rows($results) == 1) { 
        $data=mysqli_fetch_assoc($results);} 
echo '<img src="data:image/jpeg;base64,'.base64_encode($data['USER_PICTURE'] ).'" alt="profile pic" style="width:15%; border-radius:100%;"/> ';
echo '<h2>'. $data['USER_NAME'].'</h2>' ;
echo '<p>'. $data['USER_EMAIL'].'</p>';
?>
</section>

<section id="main" class="container">
	<header>
		<h2>My Active Listing</h2>
  </header>
		<div class="row">
		
<!--build FOR LOOP here & echo-->
<?php  
  $query = "SELECT * FROM `POST` WHERE `USER_ID`='$id'";  
  $results = mysqli_query($conn, $query); 
  while($data = mysqli_fetch_array($results))
{
  if($data['POST_QUANTITY']>0){ //Only show quantity >0
?>

<div class="col-6 col-12-narrower">
<section class="box special">

 <span class="image featured"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($data['POST_PICTURE'] ).'" height="200" width="200"/>';?></span>   
    <h3><?php echo $data['POST_ITEM_NAME']; ?></h3>
    <li> Description: 
    <?php echo $data['POST_DESCRIPTION']; ?> </li>
    <li> Location: 
    <?php echo $data['POST_LOCATION']; ?></li>
    
    <!--update quantity here-->
    <li> Quantity: </li>
    <form method="POST">
    <input type="number" id="quan" name="quantity" value="<?php echo $data['POST_QUANTITY'] ?>">
			<br>
	
			<ul class="actions special">

      <li>
        <input type="submit" name="update" value="Update" class="button"> 
      </li>

      <li>
        <a href="delete.php?id=<?php echo $data['POST_ID']; ?>" class="button" onclick="alert('Listing is sucessfully deleted!')">Delete</a>
      </li>

			</ul>
    </form>  

    <?php
    $qry = mysqli_query($conn,"SELECT * FROM `POST` where 'POST_ID'='$id'"); // select query
    $data = mysqli_fetch_array($qry); 
    
    if(isset($_POST['update'])) // when click on Update button
    {
    $quantity = $_POST['quantity'];

    $query = "UPDATE `post` SET `POST_QUANTITY` = '$quantity' WHERE `post`.`POST_ID` = '$id'";  
  if ($conn->query($query) === TRUE) {
  // echo "Record updated successfully";
   //header("location:profileinfo.php");
 } else {
   echo "Error updating record: " . $conn->error;
 }
}
    ?>

<?php
} //End If
?>

<?php
} //End while
?>

</section>

<!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>