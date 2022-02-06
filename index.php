<?php 

session_start();

/*Heroku
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;

$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
*/

include('connection.php'); 

//echo 'hi'.$cleardb_url;
/*
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
 }
 echo nl2br("\nConnected successfully to " . $db . " database.\n\n\n");*/

if(!$_SESSION['logged_in']) { //check if user login or not
    header("location:login_form.php"); 
    die(); 
}

if(isset($_POST['submit-report']))
{
    include('send_report.php');
    unset($_POST['submit-report']);
}

$conn = mysqli_connect("localhost", "root", "", "rizqi");
if (!$conn)
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
$result = mysqli_query($conn, $query);
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="jquery-3.6.0.js"></script>
        <script src="home.js"></script>
        <title>Rizqi | Feed</title>
    </head>
    <body>
        <!-- Report Modal Popup Start -->
        <div class="report-modal-popup-container" id="report-overlay">
            <div class="report-form-panel">
                <button id="report-form-panel-close-button">X</button>
                <div class="report-form-panel-title">Report Form</div>
                <form method="post" action="" id="report-form">
                    <input type="hidden" id="reporting_post_id" name="reporting_post_id" value="">
                    <label for="report-category-select-menu">Category:</label>
                    <select id="report-category-select-menu" name="report_category">
                        <option value="Dangerous Or Illegal Items">Dangerous Or Illegal Items</option>
                        <option value="Violent Or Inappropriate">Violent Or Inappropriate</option>
                        <option value="Dangerous Substances">Dangerous Substances</option>
                        <option value="Fraud">Fraud</option>
                        <option value="Spam">Spam</option>
                        <option value="Other">Other</option>
                    </select>
                    <label for="report-description-textarea">Description:</label>
                    <textarea name="report_description" class="report-description-textarea"></textarea>
                    <input type="submit" value="Submit Report" name="submit-report">
                </form>
            </div>
        </div>
        <!-- Report Modal Popup End -->
        <!-- Header Start -->
        <header id="header">
        	<h4 class="logo">Rizqi <i class="fa fa-handshake-o"></i></h4>
					<nav id="nav">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="createpost.php">Post</a></li>
							<li><a href="profileinfo.php">My Profile</a></li>
							<li><a href="logout.php" class="button" style="text-decoration: none;">Logout</a></li>
						</ul>
					</nav>
		</header>
        <!-- Header End -->
        <div class="feed-page-wrapper">
            <!-- Page Title Start -->
            <section id="banner">
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
            </section>
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
                        <br>
                        <!-- <div class="feed-item-quantity-and-category-container"> -->
                            <div>
                            <span class="feed-item-quantity">
                            <p><i class='fas fa-calculator' style='font-size:20px;color: #191035;'></i> <?php
                                    echo $row['POST_QUANTITY'];
                                ?> Left</p>
                            </span>
                            </div>
                            
                        <!-- </div> -->
                        <div class="feed-item-location">
                            <p><i class="fa fa-map-pin" style="font-size:20px; color: #191035;"></i> <?php
                                echo $row['POST_LOCATION'];
                            ?></p>
                        </div>
                        <div class="feed-item-description">
                        <i class='fas fa-comment' style='font-size:20px;color: #191035;'></i> <?php
                                echo $row['POST_DESCRIPTION'];
                            ?>
                        </div>
                        <?php
                            $current_user_id = $row['USER_ID'];
                            $user_query = "SELECT `USER_NAME`, `USER_EMAIL`, `USER_PHONE_NUMBER`, `USER_PICTURE` FROM `user` WHERE `USER_ID` = 1;";
                            $user_result = mysqli_query($conn, $user_query);
                            if (!$user_result)
                            {
                                echo("Error performing MySQL query.");
                            }
                            $user_result_row = mysqli_fetch_assoc($user_result);
                        ?>
                        <br>
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
                        <br>
                        <div class="feed-item-interaction-buttons-container">
                            <a href="https://wa.me/<?php echo($user_result_row['USER_PHONE_NUMBER']); ?>" target="_blank">
                                <button class="contact">
                                    Contact Me
                                </button>
                            </a>
                            <button class="report" post_id="<?php echo($row['POST_ID']) ?>">Report</button>
                        </div>
                        <br>
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
        <br>
        <!-- Page Wrapper End -->
        <footer id="footer">
			<ul class="copyright">
				<li>&copy; Rizqi. All rights reserved.</li>
			</ul>
			<br>
			<ul class="icons">
				<li><a href="https://github.com/teohsinyee/Rizqi-SDGs-Solution" class="icon brands fa-github" target="_blank"><span class="label">Github</span></a></li>
			</ul><br>
		</footer>
        
    </body>
</html>
