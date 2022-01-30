<?php 

session_start();

if(!isset($_SESSION['userID']) || !isset($_SESSION['logged_in'])){

    echo "Oops, you're not supposed to be here\n";
    echo 'You will be redirected in  5 seconds. If not, click <a href="login_form.php">here</a>.';
    header( "refresh:5;url=login_form.php" );
    exit;

} else{
    echo 'hi'.$_SESSION['username'];
    echo 'Congratulations! You are logged in!';
    echo 'You will be redirected in  3 seconds. If not, click <a href="homepage.php">here</a>.';
    header( "refresh:1;url=homepage.php" );
    die();
}









?>