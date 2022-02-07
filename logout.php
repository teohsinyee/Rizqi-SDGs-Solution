<?php

    session_destroy(); // destroy the session
    unset($_SESSION['username']); //remove all session variables
    unset($_SESSION['userID']); 
    unset($_SESSION['logged_in']);
    header('location: login_form.php'); //header() function sends a raw HTTP header to a client.

  ?>