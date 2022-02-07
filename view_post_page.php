<?php
    session_start();

    if(!$_SESSION['admin_logged_in']) { //check if admin login or not
        header("location:admin_login_form.php"); 
        die(); 
    }
    //heroku
    $servername = "us-cdbr-east-05.cleardb.net";
    $username = "bea65a9aaea3de";
    $password = "3b99e784";
    $db = "heroku_f1d328fd0c6533b";
    $db_handle = mysqli_connect($servername, $username, $password,$db);
    //$db_handle = mysqli_connect("localhost", "root", "", "rizqi");

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
    <link rel="stylesheet" href="report_page.css">
    <title>Rizqi | View Post</title>
</head>
<body>
    
    <div class= "content">
        <a href="report_page.php"><button style="float: left;"><<</button></a>
        <br>
        <h1>Post Details </h1>
        <?php echo ('<img src="data:image/png;base64,' . base64_encode($result_row['POST_PICTURE']) . '" class="feed-item-picture"/>'); ?>
        <p>Post ID: <?php echo($result_row['POST_ID']); ?></p>
        <p>User ID: <?php echo($result_row['USER_ID']); ?></p>
        <p>Item Name: <?php echo($result_row['POST_ITEM_NAME']); ?></p>
        <p>Description: <?php echo($result_row['POST_DESCRIPTION']); ?></p>
        <p>Post Quantity: <?php echo($result_row['POST_QUANTITY']); ?></p>
        <p>Post Location: <?php echo($result_row['POST_LOCATION']); ?></p>  
    </div>
</body>
</html>