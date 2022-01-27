<?php

    session_destroy(); // destroy the session
    unset($_SESSION['username']); //remove all session variables
    header('location: login_form.php'); //header() function sends a raw HTTP header to a client.

  ?>