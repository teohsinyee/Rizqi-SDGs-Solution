<?php 
include('connection.php'); 
session_start();
$errors = array(); 
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>New Post</title>
		<link rel="icon" type="image/x-icon" href="https://64.media.tumblr.com/34d27d0e919fd4a61946def0c6659b63/tumblr_inline_mgfxr4hoqm1roozkr.gif">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
				<h4 class="logo">Rizqi <i class="fa fa-handshake-o"></i></h4>
					<nav id="nav">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="createpost.php">Post</a></li>
							<li><a href="profileinfo.php">My Profile</a></li>
							<li><a href="logout.php" class="button">Logout</a></li>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container">
					<header>
						<h2>New Post</h2>
						<p>Create a new post here.</p>
					</header>
					<div class="box post">

<!--FORM HERE-->

<form action="uploadpost.php" method="post" enctype="multipart/form-data">

<label for="iname">Item name</label>
<input type="text" id="iname" name="itemname" placeholder="Item name" required>
<br>

<label for="idesc">Item description</label>
<textarea id="idesc" placeholder="Description"  name="itemdescription" rows="4" cols="50" required></textarea>
<br>

<label for="ipic">Item picture</label>
<input type="file" id="ipic" name="itemimage" required>
<br><br>

<label for="quan">Quantity</label>
<input type="number" id="quan" name="itemquantity" placeholder="0" required>
<br><br>

<label for="cat">Category</label>
<select id="cat" name="itemcategory" required>
    <option value="food">Food</option>
    <option value="non-food">Non-Food</option>
</select>
<br><br>

<label for="loc">Location</label>
<input type="text" id="loc" name="itemlocation" placeholder="Location" required>
<br><br>

<button type="submit" name="insert" class="button" >Create Post</button> 

</form>

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