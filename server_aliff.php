<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'fixerupper');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username     = mysqli_real_escape_string($db, $_POST['username']);
  $email        = mysqli_real_escape_string($db, $_POST['email']);
  $password_1   = mysqli_real_escape_string($db, $_POST['password_1']); //enter pw for twice
  $password_2   = mysqli_real_escape_string($db, $_POST['password_2']);
  $phone_number = mysqli_real_escape_string($db, $_POST['phone']);
  $address      = mysqli_real_escape_string($db, $_POST['address']);
  $acc_type     = mysqli_real_escape_string($db, $_POST['acc_type']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($phone_number)) { array_push($errors, "Phone number is required"); }
  if (empty($address)) { array_push($errors, "Address is required"); }
  if (empty($acc_type)) { array_push($errors, "Select client or freelancer"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  if ($acc_type == "client"){
    $user_check_query = "SELECT * FROM client WHERE CLIENT_USERNAME='$username' OR CLIENT_EMAIL='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { // if user exists
      if ($user['CLIENT_USERNAME'] === $username) {
        array_push($errors, "Username already exists");
      }

      if ($user['CLIENT_EMAIL'] === $email) {
        array_push($errors, "email already exists");
      }
    }
  }else {
    $user_check_query = "SELECT * FROM freelancer WHERE FREELANCER_USERNAME='$username' OR FREELANCER_EMAIL='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { // if user exists
      if ($user['FREELANCER_USERNAME'] === $username) {
        array_push($errors, "Username already exists");
      }

      if ($user['FREELANCER_EMAIL'] === $email) {
        array_push($errors, "email already exists");
      }
    }
    
  }
  

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

    if ($acc_type == "client") {
      $query = "INSERT INTO client (CLIENT_USERNAME, CLIENT_EMAIL, CLIENT_PASSWORD, CLIENT_MOBILE_NUMBER, CLIENT_ADDRESS) 
        VALUES('$username', '$email', '$password', '$phone_number', '$address')";
    }else {
      $query = "INSERT INTO freelancer (FREELANCER_USERNAME, FREELANCER_EMAIL, FREELANCER_PASSWORD, FREELANCER_MOBILE_NUMBER, FREELANCER_ADDRESS) 
        VALUES('$username', '$email', '$password', '$phone_number', '$address')";
    }
  	
  	
    mysqli_query($db, $query);
    //session variables that set in the previous page
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}

// LOGIN USER

if (isset($_POST['login_user'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $acc_type = mysqli_real_escape_string($db, $_POST['acc_type']);
    if (empty($email)) {
        array_push($errors, "Email is required"); //mandatory field
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (empty($acc_type)) {
      array_push($errors, "Select client or freelancer");
  }
  
    if (count($errors) == 0 and $acc_type=="client") {
        $password = md5($password); //hashing input pw
        //search based on hashing pw
        
        $query = "SELECT * FROM client WHERE CLIENT_EMAIL='$email' AND CLIENT_PASSWORD='$password'"; 
        $results = mysqli_query($db, $query); //store in object

        //if pw is correct
        if (mysqli_num_rows($results) == 1) { //if there is something in the result
          $data=mysqli_fetch_assoc($results); //array
          $_SESSION['username'] = $data['CLIENT_USERNAME'];
          $_SESSION['success'] = "You are now logged in";
          header('location: home.php');
        }else { //if pw is wrong
            array_push($errors, "Wrong username/password combination");
        }
    }
    elseif(count($errors)==0 and $acc_type="freelancer"){
      $password = md5($password); //hashing the input
        $query = "SELECT * FROM freelancer WHERE FREELANCER_EMAIL='$email' AND FREELANCER_PASSWORD='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) { 
          $data=mysqli_fetch_assoc($results); //fetch result row as associate array
          $_SESSION['username'] = $data['FREELANCER_USERNAME']; //assign session to this particular user
          $_SESSION['success'] = "You are now logged in";
          header('location: home.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
  
  //logout
  if(isset($_GET['logout'])){
    session_destroy(); // destroy the session
    unset($_SESSION['username']); //remove all session variables
    header('location: login.php'); //header() function sends a raw HTTP header to a client.
  }


/*
How does it work? How does it know it's me?

Most sessions set a user-key on the user's computer that looks something like this: 765487cf34ert8dede5a562e4f3a7e12. 
Then, when a session is opened on another page, 
it scans the computer for a user-key. If there is a match, it accesses that session, if not, it starts a new session.
*/


  ?>

  