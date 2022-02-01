<?php
session_start();

$errors = array(); 
$username = "";
$email    = "";
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
if (isset($_POST['login_user'])) {

    // receive all input values from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "Enter your user ID in the format domain\user or user@domain"); //mandatory field
    }
    if (empty($password)) {
        array_push($errors, "Enter your password");
    }

    if (count($errors) == 0) {
        $password_hashed = md5($password); //hashing input pw
        //search based on hashing pw
        
        $query = "SELECT * FROM USER WHERE USER_EMAIL='$email' AND USER_PASSWORD='$password_hashed'"; 
        $results = mysqli_query($conn, $query); //return object 

        //if pw is correct
        if (mysqli_num_rows($results) == 1) { //if there is something in the result
          $data=mysqli_fetch_assoc($results); //array
          $_SESSION['username'] = $data['USER_NAME'];
          $_SESSION['success'] = "You are now logged in";
          $_SESSION['logged_in'] = time();
          //echo  "Welcome ". $_SESSION['username'];
         // header('location: index.html');
         header('location: protected.php');
        }else { //if pw is wrong
            array_push($errors, "Wrong username/password combination");
        }
    }

}

?>