<?php
    session_start();
    if(!$_SESSION['admin_logged_in']) { //check if admin login or not
        header("location:admin_login_form.php"); 
        die(); 
    }
    $db_handle = mysqli_connect("localhost", "root", "", "rizqi");
    if(isset($_GET['post_id']))
    {
        $post_id = $_GET['post_id'];
        $result = mysqli_query($db_handle, "SELECT * FROM post WHERE POST_ID = '$post_id';");
        $result_row = mysqli_fetch_assoc($result);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rizqi | View Post</title>
</head>
<body>
    <div>Post ID: <?php echo($result_row['POST_ID']); ?></div>
    <div>User ID: <?php echo($result_row['USER_ID']); ?></div>
    <div>Item Name: <?php echo($result_row['POST_ITEM_NAME']); ?></div>
    <div>Description: <?php echo($result_row['POST_DESCRIPTION']); ?></div>
    <div>Picture: <?php echo ('<img src="data:image/png;base64,' . base64_encode($result_row['POST_PICTURE']) . '"/>'); ?></div>
    <div>Post Quantity: <?php echo($result_row['POST_QUANTITY']); ?></div>
    <div>Post Location: <?php echo($result_row['POST_LOCATION']); ?></div>
    <div><a href="report_page.php">Click here to return to the reports table</a></div>
</body>
</html>