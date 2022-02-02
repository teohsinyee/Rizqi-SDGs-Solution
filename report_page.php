<?php
session_start();

if(!$_SESSION['admin_logged_in']) { //check if admin login or not
    header("location:admin_login_form.php"); 
    die(); 
}

$db_handle = mysqli_connect("localhost", "root", "", "rizqi");
$query = "SELECT * FROM reports ORDER BY FIELD(REPORT_STATUS, 'UNSOLVED', 'SOLVED');";
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
        <table>
            <tr>
                <th>Report ID</th>
                <th>Reporter User ID</th>
                <th>Post Owner User ID</th>
                <th>Post ID</th>
                <th>Admin ID</th>
                <th>Description</th>
                <th>Category</th>
                <th>Date</th>
                <th>Time</th>
                <th>Link To Post</th>
                <th>Toggle Status Action</th>
                <th>Toggle User Suspension</th>
                <th>Delete Post Action</th>
                <th>Delete Report Action</th>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result))
                {
                    $datetime = new DateTime($row['REPORT_DATETIME']);
                    echo
                    ("
                    <tr>
                    <td>" . $row['REPORT_ID'] ."</td>
                    <td>" . $row['REPORTING_USER_ID'] ."</td>
                    <td>" . $row['POST_OWNER_USER_ID'] ."</td>
                    <td>" . $row['POST_ID'] ."</td>
                    <td>" . $row['ADMIN_ID'] ."</td>
                    <td>" . $row['REPORT_DESCRIPTION'] ."</td>
                    <td>" . $datetime ->format('d/m/Y') ."</td>
                    <td>" . $datetime ->format('H:i:s') ."</td>
                    <td>" . $row['REPORT_STATUS'] ."</td>
                    <td>" . "<a>link placeholder</a>" ."</td>
                    <td>Toggle Status Action</td>
                    <td>Toggle User Suspension</td>
                    <td>Delete Post Action</td>
                    <td>Delete Report Action</td>
                    </tr>
                    ");
                }
            ?>
        </table>
    </body>
</html>