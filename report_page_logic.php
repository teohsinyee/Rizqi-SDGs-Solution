<?php
    session_start();
    if(!$_SESSION['admin_logged_in']) { //check if admin login or not
        header("location:admin_login_form.php"); 
        die(); 
    }
    $admin_id = $_SESSION['admin_id'];
    $report_id = $_GET['report_id'];

    //heroku
    $servername = "us-cdbr-east-05.cleardb.net";
    $username = "bea65a9aaea3de";
    $password = "3b99e784";
    $db = "heroku_f1d328fd0c6533b";
    $db_handle = mysqli_connect($servername, $username, $password,$db);


    /* For deleting posts */
    if(isset($_GET['target_post_id']))
    {
        $post_id = $_GET['target_post_id'];
        mysqli_query($db_handle, "DELETE FROM post WHERE POST_ID = '$post_id';");
    }
    /* For toggling user suspension */
    if(isset($_GET['target_user_id']))
    {
        $user_id = $_GET['target_user_id'];
        $current_suspension_status_row = mysqli_query($db_handle, "SELECT USER_SUSPENSION_STATUS FROM user WHERE USER_ID = '$user_id';");
        print_r($current_suspension_status_row);
        $current_suspension_status = mysqli_fetch_assoc($current_suspension_status_row)['USER_SUSPENSION_STATUS'];
        if($current_suspension_status == "NOT SUSPENDED")
        {
            mysqli_query($db_handle, "UPDATE user SET USER_SUSPENSION_STATUS = 'SUSPENDED' WHERE USER_ID = '$user_id';");
        }
        else
        {
            mysqli_query($db_handle, "UPDATE user SET USER_SUSPENSION_STATUS = 'NOT SUSPENDED' WHERE USER_ID = '$user_id';");
        }
    }
    /* For editing report status and deleting reports */
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
        if($action == "toggle_status")
        {
            $current_report_status_row = mysqli_fetch_assoc(mysqli_query($db_handle, "SELECT REPORT_STATUS FROM reports WHERE REPORT_ID = '$report_id';"));
            $current_report_status = $current_report_status_row['REPORT_STATUS'];
            if($current_report_status == 'UNSOLVED')
            {
                mysqli_query($db_handle, "UPDATE reports SET REPORT_STATUS = 'SOLVED' WHERE REPORT_ID = '$report_id';");
            }
            else if($current_report_status == 'SOLVED')
            {
                mysqli_query($db_handle, "UPDATE reports SET REPORT_STATUS = 'UNSOLVED' WHERE REPORT_ID = '$report_id';");
            }
        }
        else if($action = "delete_report")
        {
            /* mysqli_query($db_handle, "DELETE FROM report WHERE REPORT_ID = '$report_id';"); */
            mysqli_query($db_handle, "UPDATE reports SET REPORT_STATUS = 'ARCHIVED' WHERE REPORT_ID = '$report_id';");
        }
    }

    /* Updating the admin ID field to track tampering */
    mysqli_query($db_handle, "UPDATE reports SET ADMIN_ID = '$admin_id' WHERE REPORT_ID = '$report_id';");
    header("location:report_page.php");
?>