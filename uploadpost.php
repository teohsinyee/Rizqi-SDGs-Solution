<?php
include('connection.php');  
session_start();

$id = $_SESSION['userID'];

$status = $statusMsg = ''; 

if (isset($_POST['insert'])) {
    $status = 'error';
    if(!empty($_FILES["itemimage"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["itemimage"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    
     // Allow certain file formats 
     $allowTypes = array('jpg','png','jpeg', 'JPG', 'PNG', 'JPEG'); 
    if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['itemimage']['tmp_name']; 
            $imgContent = (addslashes(file_get_contents($image)));     

            $itemname = $_REQUEST['itemname']; 
            $itemdescription= $_REQUEST['itemdescription'];
            $itemquantity = $_REQUEST['itemquantity'];
            $itemlocation = $_REQUEST['itemlocation'];
            $itemcategory = $_REQUEST['itemcategory'];

        $query = 
        "INSERT INTO `post` (`POST_ID`, `USER_ID`, `POST_ITEM_NAME`, `POST_DESCRIPTION`, `POST_PICTURE`, `POST_QUANTITY`, 
        `POST_LOCATION`, `POST_CATEGORY`, `POST_DATETIME`) 
        VALUES (NULL, '$id', '$itemname', '$itemdescription','$imgContent' , '$itemquantity', 
        '$itemlocation', '$itemcategory', current_timestamp())";


        if($conn->query($query) === TRUE){ //check INSERT success or not
            $status = 'success'; 
            $statusMsg = "File uploaded successfully."; 
        }else{ 
            $statusMsg = "File upload failed, please try again."; 
        }  
}else{ 
    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
} 
    }else{ $statusMsg = 'Please select an image file to upload.'; } 

}


echo ("<script LANGUAGE='JavaScript'>
    window.alert('Post successfully created!');
    window.location.href='index.php';
    </script>");

?>
