<?php

session_start();

if(!$_SESSION['logged_in']) { //check if user login or not
  header("location:login_form.php"); 
  die(); 
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>𝐑𝐢𝐳𝐪𝐢</title>
		<link rel="icon" type="image/x-icon" href="https://64.media.tumblr.com/34d27d0e919fd4a61946def0c6659b63/tumblr_inline_mgfxr4hoqm1roozkr.gif">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body class="landing is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<h4 class="logo">Rizqi</h4>
					<nav id="nav">
						<ul>
							<li><a href="homepage.php">Home</a></li>
							<li><a href="createpost.php">Post</a></li>
							<li><a href="profileinfo.php">My Profile</a></li>
							<li><a href="logout.php" class="button">Logout</a></li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					<h2>My Feed</h2>
					<br><br>
					<ul class="actions special">
						<!-- add hover when click -->
						<li><a onclick="filterChoose('all')" class="button active">All </a></li>
						<li><a onclick="filterChoose('food')" class="button">Food </a></li>
						<li><a onclick="filterChoose('nonfood')" class="button">Non-Food</a></li>
					</ul>
				</section>

			<!-- Main -->
				<section id="main" class="container">
					<div class="row">
						<div class="col-6 col-12-narrower">

							<section class="box special">
								<span class="image featured"><img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="" /></span>
								<h3>Salad</h3>
								<p> <a href="#">by Kafe Bakti</a></p>
								<p> </p>
								<br>
								<li> Item description: Sungguh enak dimakan begitu sahaja </li>
    							<li> Quantity: 10 </li>
    							<li class="filterClick food"> Category: Food </li>
								<li>Location: Kafe Bakti</li>
								<br>
								<ul class="actions special">
									<li><a href="https://wa.link/877yhf" target="_blank" class="button">Contact Me</a></li>
									<button class="btr" onclick="myFunction('button1')"><i class="fa fa-flag-o"></i></button>
								</ul>
								<div id="button1" class="generalclass">
									<h3>What do want to report?</h3>
									<select id="report" name="report">
									<form action="#">
									<option value="food">Spamming</option>
									<option value="non-food">Hate speech</option>
									<option value="non-food">Racist language/activity</option>
									<option value="non-food">Illegal item</option>
									<option value="non-food">Nudity</option>
									</select><br>
									<input onclick="alert('Successfully reported!')" type="submit" value="Submit">
									</form>
								</div>
							</section>

						</div>
						<div class="col-6 col-12-narrower">

							<section class="box special">
								<span class="image featured"><img src="data:image/jpeg;base64,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" alt="" /></span>
								<h3>Pail</h3>
								<p> <a href="#">by Aliff Iskandar</a></p>
								<br>
								<li> Item description: Baldi untuk mandi dan wangi macam saya </li>
    							<li> Quantity: 1 </li>
    							<li class="filterClick nonfood"> Category: Non-Food </li>
								<li> Location: M01 Restu</li>
								<br>
								<ul class="actions special">
									<li><a href="https://wa.link/877yhf" target="_blank" class="button">Contact Me</a></li>
									<button class="btr" onclick="myFunction('button2')"><i class="fa fa-flag-o"></i></button>
								</ul>
								<div id="button2" class="generalclass">
									<h3>What do want to report?</h3>
									<select id="report" name="report">
									<form action="#">
									<option value="food">Spamming</option>
									<option value="non-food">Hate speech</option>
									<option value="non-food">Racist language/activity</option>
									<option value="non-food">Illegal item</option>
									<option value="non-food">Nudity</option>
									</select><br>
									<input onclick="alert('Successfully reported!')" type="submit" value="Submit">
									</form>
								</div>
							</section>

						</div>
					</div>

					<div class="row">
						<div class="col-6 col-12-narrower">

							<section class="box special">
								<span class="image featured"><img src="https://media.karousell.com/media/photos/products/2021/12/26/matriculation_past_year_questi_1640530892_688095aa.jpg" alt="" /></span>
								<h3>Matriculation Book</h3>
								<p><a href="#">by Teoh Sin Yee</a></p>
								<br>
								<li> Item description: Beli buku auto bijak macam saya </li>
    							<li> Quantity: 3 </li>
    							<li class="filterClick nonfood"> Category: Non-Food </li>
								<li> Location: M02 Restu</li>
								<br>
								<ul class="actions special">
									<li><a href="https://wa.link/877yhf" target="_blank" class="button">Contact Me</a></li>
									<button class="btr" onclick="myFunction('button3')"><i class="fa fa-flag-o"></i></button>
								</ul>
								<div id="button3" class="generalclass">
									<h3>What do want to report?</h3>
									<select id="report" name="report">
									<form action="#">
									<option value="food">Spamming</option>
									<option value="non-food">Hate speech</option>
									<option value="non-food">Racist language/activity</option>
									<option value="non-food">Illegal item</option>
									<option value="non-food">Nudity</option>
									</select><br>
									<input onclick="alert('Successfully reported!')" type="submit" value="Submit">
									</form>
								</div>
							</section>

						</div>
						<div class="col-6 col-12-narrower">

							<section class="box special">
								<span class="image featured"><img src="https://abambam.com/wp-content/uploads/2020/05/nasi-lemak-daun-pisang.jpg" alt="" /></span>
								<h3>Nasi Lemak</h3>
								<p> <a href="#">by Masakan Panas</a></p>
								<br>
								<li> Item description: Nasi lemak kaw kaw sedap mkn auto bijak </li>
    							<li> Quantity: 4 </li>
    							<li class="filterClick nonfood"> Category: Food </li>
								<li> Location: M07 Kafe Saujana</li>
								<br>
								<ul class="actions special">
									<li><a href="https://wa.link/877yhf" target="_blank" class="button">Contact Me</a></li>
									<button class="btr" onclick="myFunction('button4')"><i class="fa fa-flag-o"></i></button>
								</ul>
								<div id="button4" class="generalclass">
									<h3>What do want to report?</h3>
									<select id="report" name="report">
									<form action="#">
									<option value="food">Spamming</option>
									<option value="non-food">Hate speech</option>
									<option value="non-food">Racist language/activity</option>
									<option value="non-food">Illegal item</option>
									<option value="non-food">Nudity</option>
									</select><br>
									<input onclick="alert('Successfully reported!')" type="submit" value="Submit">
									</form>
								</div>
							</section>

						</div>
					</div>
					
				</section>



			<!-- Footer -->
				<footer id="footer">
					<ul class="copyright">
						<li>&copy; Rizqi. All rights reserved.</li>
					</ul>
					<br>
					<ul class="icons">
						<li><a href="https://github.com/teohsinyee/Rizqi-SDGs-Solution" class="icon brands fa-github" target="_blank"><span class="label">Github</span></a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script>
				function myFunction(divid) {
				
				  var x = document.getElementById(divid);  
				  
				  if (x.style.display == "none") 
				  {
					x.style.display = "block";
				  } 
				  else {
					x.style.display = "none";
				  }  
				}
			</script>

	</body>
</html>