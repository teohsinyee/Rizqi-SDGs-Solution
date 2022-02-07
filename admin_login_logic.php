<?php
session_start();

$errors = array(); 
$username = "";
$email    = "";

/*heroku
$servername = "us-cdbr-east-05.cleardb.net";
$username = "bea65a9aaea3de";
$password = "3b99e784";
$db = "heroku_f1d328fd0c6533b";
$conn = mysqli_connect($servername, $username, $password,$db);
*/

$servername = "localhost";
$username = "root";
$password = "";
$db = "Rizqi";
$conn = mysqli_connect($servername, $username, $password,$db);


// Check connection
/*if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo nl2br("\nConnected successfully to " . $db . " database.\n\n\n");*/

//if user submitted login form
if (isset($_POST['login_admin'])) {

    // receive all input values from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Email is required"); //mandatory field
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password_hashed = md5($password); //hashing input pw
        //search based on hashing pw
        
        $query = "SELECT * FROM `admin` WHERE ADMIN_USERNAME='$email' AND ADMIN_PASSWORD='$password_hashed'"; 
        $results = mysqli_query($conn, $query); //return object 

        //if pw is correct
        if (mysqli_num_rows($results) == 1) { //if there is something in the result
          $data=mysqli_fetch_assoc($results); //array
          $_SESSION['admin_id'] = $data['ADMIN_ID'];
          $_SESSION['success'] = "You are now logged in";
          $_SESSION['admin_logged_in'] = time();

         
        }else { //if pw is wrong
            array_push($errors, "Wrong username/password combination");
        }
    }

}

if (isset($_SESSION['admin_logged_in']))
{
    header('location: report_page.php');
}

?>