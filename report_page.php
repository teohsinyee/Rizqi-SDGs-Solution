<?php
session_start();
if(!$_SESSION['admin_logged_in']) { //check if admin login or not
    header("location:admin_login_form.php"); 
    die(); 
}

/*heroku
$servername = "us-cdbr-east-05.cleardb.net";
$username = "bea65a9aaea3de";
$password = "3b99e784";
$db = "heroku_f1d328fd0c6533b";
$db_handle = mysqli_connect($servername, $username, $password,$db);*/

$db_handle = mysqli_connect("localhost", "root", "", "rizqi");
$query = "SELECT * FROM reports WHERE POST_ID IS NOT NULL && REPORT_STATUS != 'ARCHIVED' ORDER BY FIELD(REPORT_STATUS, 'UNSOLVED', 'SOLVED'), REPORT_DATETIME ASC;";
$result = mysqli_query($db_handle, $query);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="https://64.media.tumblr.com/34d27d0e919fd4a61946def0c6659b63/tumblr_inline_mgfxr4hoqm1roozkr.gif">
        <link rel="stylesheet" href="report_page.css">
        <title>Rizqi | Reports</title>
    </head>
    <body>
        <a href="admin_logout.php"><button>Log Out</button></a>
        <table class="reports-table">
            <tr>
                <th>Report ID</th>
                <th>Reporter User ID</th>
                <th>Post Owner User ID</th>
                <th>Suspension Status</th>
                <th>Post ID</th>
                <th>Admin ID</th>
                <th>Description</th>
                <th>Category</th>
                <th>Date</th>
                <th>Time</th>
                <th>Report Status</th>
                <th>Link To Post</th>
                <th>Toggle Report Status Action</th>
                <th>Toggle User Suspension</th>
                <th>Delete Post Action</th>
                <th>Delete Report Action</th>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result))
                {
                    $datetime = new DateTime($row['REPORT_DATETIME']);
                    $post_owner_user_id = $row['POST_OWNER_USER_ID'];
                    $post_owner_suspension_status_row = mysqli_query($db_handle, "SELECT USER_SUSPENSION_STATUS FROM user WHERE USER_ID = '$post_owner_user_id';");
                    $post_owner_suspension_status = mysqli_fetch_assoc($post_owner_suspension_status_row)['USER_SUSPENSION_STATUS'];
                    $post_id = $row['POST_ID'];
                    echo
                    ("
                    <tr>
                    <td>" . $row['REPORT_ID'] ."</td>
                    <td>" . $row['REPORTING_USER_ID'] ."</td>
                    <td>" . $post_owner_user_id ."</td>
                    <td>" . $post_owner_suspension_status ."</td>
                    <td>" . $post_id ."</td>
                    <td>" . $row['ADMIN_ID'] ."</td>
                    <td>" . $row['REPORT_DESCRIPTION'] ."</td>
                    <td>" . $row['REPORT_CATEGORY'] ."</td>
                    <td>" . $datetime ->format('d/m/Y') ."</td>
                    <td>" . $datetime ->format('H:i:s') ."</td>
                    <td>" . $row['REPORT_STATUS'] ."</td>
                    <td>" . "<a href='view_post_page.php?post_id=". $post_id ."'>View Post Details</a>" ."</td>
                    <td><a href='report_page_logic.php?action=toggle_status&report_id=". $row['REPORT_ID'] ."'>Toggle Report Status</a></td>
                    <td><a href='report_page_logic.php?target_user_id=". $post_owner_user_id ."&report_id=". $row['REPORT_ID'] ."'>Toggle User Suspension</a></td>
                    <td><a href='report_page_logic.php?target_post_id=". $post_id ."&report_id=". $row['REPORT_ID'] ."'>Delete Post</a></td>
                    <td><a href='report_page_logic.php?action=delete_report&report_id=". $row['REPORT_ID'] ."'>Delete Report</a></td>
                    </tr>
                    ");
                }
            ?>
        </table>
    </body>
</html>