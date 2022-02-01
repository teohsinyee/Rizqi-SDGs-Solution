<?php
$db_handle = mysqli_connect("localhost", "root", "", "rizqi");


$report_id = null;
$reporting_user_id = 1;
$post_id = $_POST['reporting_post_id'];

$post_owner_user_id_result = mysqli_query($db_handle, "SELECT `USER_ID` FROM `post` WHERE `POST_ID` = $post_id;");
$post_owner_user_id = mysqli_fetch_assoc($post_owner_user_id_result)['USER_ID'];
$admin_id = null;
$report_description = $_POST['report_description'];
$report_category = $_POST['report_category'];
$report_post_link = "";

/* print_r($_POST); */

if(true)
{
    $query = "INSERT INTO `reports` (`REPORT_ID`, `REPORTING_USER_ID`, `POST_OWNER_USER_ID`, `POST_ID`, `ADMIN_ID`, `REPORT_DESCRIPTION`, 
    `REPORT_CATEGORY`, `REPORT_DATETIME`, `REPORT_STATUS`, `REPORT_POST_LINK`) VALUES (NULL, '$reporting_user_id', '$post_owner_user_id', 
    '$post_id', NULL, '$report_description', '$report_category', current_timestamp(), 'UNSOLVED', ''); ";

    mysqli_query($db_handle, $query);
}


?>