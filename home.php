<?php 
session_start();
$db_handle = mysqli_connect("localhost", "root", "", "rizqi");
if (!$db_handle)
{
    die("Unable to connect to MySQL database, error: " . mysqli_connect_error());
}
date_default_timezone_set("Asia/Kuala_Lumpur");
$column_per_rows = 4;
$query = "SELECT * FROM post ORDER BY `POST_DATETIME` DESC";
$active_button = "all";
if (isset($_POST['filter_category']))
{
    if($_POST['filter_category'] == "All")
    {
        $query = "SELECT * FROM post ORDER BY `POST_DATETIME` DESC";
    }
    else if($_POST['filter_category'] == "Food")
    {
        $query = "SELECT * FROM `post` WHERE `POST_CATEGORY` = 'Food' ORDER BY `POST_DATETIME` DESC ";
        $active_button = "food";
    }
    else if($_POST['filter_category'] == "Non-Food")
    {
        $query = "SELECT * FROM `post` WHERE `POST_CATEGORY` = 'Non-Food' ORDER BY `POST_DATETIME` DESC ";
        $active_button = "nonfood";
    }
}
unset($_POST['filter_category']);
$result = mysqli_query($db_handle, $query);
$number_of_rows = mysqli_num_rows($result);
$number_of_flex_rows = intdiv($number_of_rows, $column_per_rows) + 1;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <style>html{visibility: hidden;opacity:0;}</style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="https://64.media.tumblr.com/34d27d0e919fd4a61946def0c6659b63/tumblr_inline_mgfxr4hoqm1roozkr.gif">
        <link rel="stylesheet" href="aliff-styles.css">
        <title>Rizqi | Feed</title>
    </head>
    <body>
        <!-- Header Start -->
        <div class="feed-header-container">
            <a href="" class="feed-header-item feed-header-navigation-link">Home</a>
            <a href="createpost.php" class="feed-header-item feed-header-navigation-link">Post</a>
            <a href="profileinfo.php" class="feed-header-item feed-header-navigation-link">My Profile</a>
            <button class="feed-header-item feed-header-button">Logout</button>
        </div>
        <!-- Header End -->
        <!-- Page Wrapper Start -->
        <div class="feed-page-wrapper">
            <!-- Page Title Start -->
            <div class="feed-title-container">
                <span class="feed-title">Items Feed</span>
            </div>
            <!-- Page Title End -->
            <!-- Filter Buttons Container Start -->
            <div class="filter-buttons-container">
                <form action = "" method="post">
                    <input type="submit" value="All" class="filter-button" id="all-button" name="filter_category"></input>
                </form>
                <form action = "" method="post">
                    <input type="submit" value="Food" class="filter-button" id="food-button" name="filter_category"></input>
                </form>
                <form action = "" method="post">
                    <input type="submit" value="Non-Food" class="filter-button" id="nonfood-button" name="filter_category"></input>
                </form>
            </div>
            <!-- Filter Buttons Container End -->
            <!-- Active Filter Buttons Script Start-->
            <?php
                if($active_button == "all")
                {
                    echo("
                        <script>
                            document.getElementById('all-button').classList.add('active-button');
                        </script>
                    ");
                }
                else if($active_button == "food")
                {
                    echo("
                        <script>
                            document.getElementById('food-button').classList.add('active-button');
                        </script>
                    ");
                }
                if($active_button == "nonfood")
                {
                    echo("
                        <script>
                            document.getElementById('nonfood-button').classList.add('active-button');
                        </script>
                    ");
                }
            ?>
            <!-- Active Filter Buttons Script End -->
            <!-- Feed Flex Row Start -->
            <?php
                $current_flex_row_number = 0;
                $current_column_number = 0;
                for($current_flex_row_number; $current_flex_row_number < $number_of_flex_rows; $current_flex_row_number++)
                {
            ?>
            <div class="feed-item-row-container">
                <?php
                    while($row = mysqli_fetch_assoc($result))
                    {
                ?>
                <!-- Feed Item Start -->
                <div class="feed-item-container">
                    <div class="feed-item-image-container">
                        <?php echo ('<img src="data:image/png;base64,'.base64_encode($row['POST_PICTURE']).'" class="feed-item-picture"/>'); ?>
                    </div>
                    <!-- Below Section Start -->
                    <div class="feed-item-below-section-container">
                        <div class="feed-item-name">
                            <?php
                                echo $row["POST_ITEM_NAME"];
                            ?>
                        </div>
                        <div class="feed-item-quantity-and-category-container">
                            <span class="feed-item-quantity">
                                <?php
                                    echo $row['POST_QUANTITY'];
                                ?> Left
                            </span>
                            <span class="feed-item-category">
                                <?php
                                    echo $row['POST_CATEGORY'];
                                ?>
                            </span>
                        </div>
                        <div class="feed-item-location">
                            <?php
                                echo $row['POST_LOCATION'];
                            ?>
                        </div>
                        <div class="feed-item-description">
                            <?php
                                echo $row['POST_DESCRIPTION'];
                            ?>
                        </div>
                        <?php
                            $current_user_id = $row['USER_ID'];
                            $user_query = "SELECT `USER_NAME`, `USER_EMAIL`, `USER_PHONE_NUMBER`, `USER_PICTURE` FROM `user` WHERE `USER_ID` = 1;";
                            $user_result = mysqli_query($db_handle, $user_query);
                            if (!$user_result)
                            {
                                echo("Error performing MySQL query.");
                            }
                            $user_result_row = mysqli_fetch_assoc($user_result);
                        ?>
                        <div class="feed-item-interaction-buttons-container">
                            <a href="https://wa.me/<?php echo($user_result_row['USER_PHONE_NUMBER']); ?>" target="_blank"><button class="feed-item-contact-button feed-item-interaction-button">Contact Me</button></a>
                            
                            <button class="feed-item-report-button feed-item-interaction-button">Report</button>
                        </div>
                        <div class="feed-item-user-profile-picture-container">
                        <?php echo ('<img src="data:image/png;base64,'.base64_encode($user_result_row['USER_PICTURE']).'" class="feed-item-user-profile-picture"/>'); ?>
                        </div>
                        <div class="feed-item-username">
                        <?php
                            echo $user_result_row['USER_NAME'];
                        ?>
                        </div>
                        <div class="feed-item-user-email">
                        <?php
                            echo $user_result_row['USER_EMAIL'];
                        ?>
                        </div>
                        <div class="feed-item-time-elapsed">
                        <?php
                            $post_date = new DateTime($row["POST_DATETIME"]);
                            $current_date = new DateTime();
                            $time_difference = $current_date->diff($post_date);
                            echo($time_difference->format('%m Months %d Days %H Hours %i Minutes %s Seconds'));
                        ?>
                        </div>
                    </div>
                    <!-- Below Section End -->
                </div>
                <!-- Feed Item End -->
                <?php
                        $current_column_number++;
                        if($current_column_number == $column_per_rows)
                        {
                            break;
                        }
                    }
                ?>
            </div>
            <!-- Feed Flex Row End -->
            <?php
                $current_column_number = 0;
            } 
            ?>
        </div>
        <!-- Page Wrapper End -->
    </body>
</html>