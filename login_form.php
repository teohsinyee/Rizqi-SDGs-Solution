<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>

<body>
<h1>this is Login page</h1>
<form method="post" action="login_form.php" >
<?php include('errors.php'); ?>
<input type="text" class="field"  name="email" placeholder="Email">
<input type="text" class="field" name="password" placeholder="Password">

<button name="login_user">Login</button>

</form>

</body>
</html>