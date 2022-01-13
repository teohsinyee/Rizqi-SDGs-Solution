<?php include('server.php'); 
echo  "Welcome ". $_SESSION['username'];?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login page</title>

<form method="post" action="login_form.php" >
<?php include('errors.php'); ?>
<input type="text" class="field"  name="email" placeholder="Email">
<input type="text" class="field" name="password" placeholder="Password">

<button name="login_user">Login</button>

</form>

</head>

<body>
<h1>this is homepage</h1>

<a href="logout.php"><button>Logout</button></a>
</body>
</html>