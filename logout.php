<?php
    
    /*Sinyee version
    session_destroy(); // destroy the session
    unset($_SESSION['username']); //remove all session variables
    unset($_SESSION['userID']); 
    unset($_SESSION['logged_in']);
    header('location: login_form.php'); //header() function sends a raw HTTP header to a client.
    */

    //Aliff admin logout codes
    session_start();

    // Unset all of the session variables.
    session_unset();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
    header("location:login_form.php");

  ?>