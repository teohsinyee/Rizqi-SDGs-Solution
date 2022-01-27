<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="icon" type="image/x-icon" href="https://64.media.tumblr.com/34d27d0e919fd4a61946def0c6659b63/tumblr_inline_mgfxr4hoqm1roozkr.gif">
	<link rel="stylesheet" href="assets/css/login.css" />
</head>

<body>
<form method="post" action="login_form.php" >
<?php include('errors.php'); ?>

    <h1 style="text-align:center">LOG IN</h1>
	<div class="input-group">
	<label>Email</label>
        <input type="text" name="email">
    </div>

    <div class="input-group">
	<label>Password</label>
       <input type="text" name="password">
    </div>

<div class="input-group">
<button name="login_user" class="btn" type="submit">Login</button>
</div>

</form>

</body>
</html>