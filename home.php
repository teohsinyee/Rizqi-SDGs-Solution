<?php 
session_start();
$db_handle = mysqli_connect("localhost", "root", "", "rizqi");
if (!$db_handle)
{
    die("Unable to connect to MySQL database, error: " . mysqli_connect_error());
}

$query = "SELECT * FROM post";
$result = mysqli_query($db_handle, $query);
$number_of_rows = mysqli_num_rows($result);
$number_of_flex_rows = intdiv($number_of_rows, 5) + 1;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
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
                <button class="filter-button">All</button>
                <button class="filter-button">Food</button>
                <button class="filter-button">Non-Food</button>
            </div>
            <!-- Filter Buttons Container End -->
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
                        image
                    </div>
                    <!-- Below Section Start -->
                    <div class="feed-item-below-section-container">
                        <div class="feed-item-name">
                            Item Name
                        </div>
                        <div class="feed-item-quantity-and-category-container">
                            <span class="feed-item-quantity">
                                999 Left
                            </span>
                            <span class="feed-item-category">
                                Non-Food
                            </span>
                        </div>
                        <div class="feed-item-location">
                            Location
                        </div>
                        <div class="feed-item-description">
                            Item Description
                        </div>
                        <div class="feed-item-interaction-buttons-container">
                            <button class="feed-item-contact-button feed-item-interaction-button">Contact Me</button>
                            <button class="feed-item-report-button feed-item-interaction-button">Report</button>
                        </div>
                        <div class="feed-item-user-profile-picture-container">
                            <img class="feed-item-user-profile-picture">
                        </div>
                        <div class="feed-item-username">
                            Username
                        </div>
                        <div class="feed-item-user-email">
                            Email
                        </div>
                    </div>
                    <!-- Below Section End -->
                </div>
                <!-- Feed Item End -->
                <?php
                        $current_column_number++;
                        if($current_column_number == 5)
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