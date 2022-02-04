<?php
session_start();

$errors = array(); 
$username = "";
$email    = "";

//new 2.12 AM -05 FEB
$servername = "us-cdbr-east-05.cleardb.net";
$username = "bea65a9aaea3de";
$password = "3b99e784";
$db = "Rizqi";
$conn = mysqli_connect($servername, $username, $password,$db);


/* original 2.11AM -05FEB
$servername = "localhost";
$username = "root";
$password = "";
$db = "Rizqi";
$conn = mysqli_connect($servername, $username, $password,$db);
*/


//Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo nl2br("\nConnected successfully to " . $db . " database.\n\n\n");

//if user submitted login form
if (isset($_POST['login_user'])) {

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
        
        $query = "SELECT * FROM USER WHERE USER_EMAIL='$email' AND USER_PASSWORD='$password_hashed'"; 
        $results = mysqli_query($conn, $query); //return object 

        //if pw is correct
        if (mysqli_num_rows($results) == 1) { //if there is something in the result
          $data=mysqli_fetch_assoc($results); //array
          $_SESSION['userID'] = $data['USER_ID'];
          $_SESSION['username'] = $data['USER_NAME'];
          $_SESSION['USER_SUSPENSION_STATUS'] = $data['USER_SUSPENSION_STATUS'];
          $_SESSION['success'] = "You are now logged in";
          $_SESSION['logged_in'] = time();
          
          //check suspension status
          if($_SESSION['USER_SUSPENSION_STATUS'] == 'NOT SUSPENDED'){
                #header('location: index.html');
                header('location: homeprotected.php');
          }
          else{
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Your account is suspended! Contact the admin for more details.');
            </script>");
          }

         
        }else { //if pw is wrong
            array_push($errors, "Wrong username/password combination");
        }
    }

}

?>