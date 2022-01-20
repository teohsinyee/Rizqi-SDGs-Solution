<?php 
require "connection.php";

// Set connection variables
$server_name = "localhost";
$username = "root";
$password = "";
$db = "rizqi";

// Creates a new connection
$connection = new mysqli($server_name, $username, $password, $db);

// Check the connection
if ($connection->connect_error)
{
    exit("Database connection failed: " . $connection->connect_error);
}
else
{
    echo "Database connected successfully<br>";
}

$query = "SELECT * FROM post ORDER BY POST_DATETIME desc";

$result = $connection -> query($query, );

while($row = $result -> fetch_assoc())
{
    echo
    '<br>
    <div>
    Post ID: ' . $row["POST_ID"] . '<br>' .
    'User ID: ' . $row["USER_ID"] . '<br>' .
    'Item name: ' . $row["POST_ITEM_NAME"] . '<br>' .
    'Description: ' . $row["POST_DESCRIPTION"] . '<br>' .
    'Picture: ' . '<img src="data:image/jpeg;base64,'.base64_encode($row['POST_PICTURE'] ).'" height="200" width="200"/> ' . '<br>' .
    'Quantity: ' . $row["POST_QUANTITY"] . '<br>' .
    'Location: ' . $row["POST_LOCATION"] . '<br>' .
    'Category: ' . $row["POST_CATEGORY"] . '<br>' .
    'Date and Time: ' . $row["POST_DATETIME"] . '<br>' .
    '</div>';
}
?>
<br>
<form action="" method="post" enctype="multipart/form-data">
    <label>Select Image File:</label>
    <input type="file" name="image">
    <input type="submit" name="submit" value="Upload">
</form>

<?php
// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg', 'JPG', 'PNG', 'JPEG'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = (addslashes(file_get_contents($image))); 
         
            // Insert image content into database 
            $insert = $connection->query("INSERT INTO `post` (`POST_ID`, `USER_ID`, `POST_ITEM_NAME`, `POST_DESCRIPTION`, `POST_PICTURE`, 
            `POST_QUANTITY`, `POST_LOCATION`, `POST_CATEGORY`, `POST_DATETIME`) VALUES (NULL, '3', 'Daun', 'Daun jumpa atas pokok.'
            , '$imgContent', '1000', 'Pokok USM', 'FOOD', current_timestamp()) "); 
             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
?>