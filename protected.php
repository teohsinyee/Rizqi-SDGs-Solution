<?php

session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['logged_in'])){

echo "Oops, you're not supposed to be here\n";
echo 'You\'ll be redirected in  5 seconds. If not, click <a href="home.php">here</a>.';
header( "refresh:5;url=home.php" );
exit;
}

echo 'hi'.$_SESSION['username'];
echo 'Congratulations! You are logged in!';
echo 'You\'ll be redirected in  3 seconds. If not, click <a href="home.php">here</a>.';
header( "refresh:2;url=home.php" );
die();


?>