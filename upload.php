<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/19/2016
 * Time: 1:42 PM
 * NEW.PHP
 * Allows user to create a new entry in the database
 */

$target_dir = "dat/";
$fileName = basename($_FILES["fileToUpload"]["name"]);
echo $fileName;
$target_file = $target_dir . $fileName;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists, deleting.";
        chmod($target_file,0777); //Change the file permissions if allowed
        unlink($target_file); //remove the file
        $uploadOk = 1;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "csv")
     {
        echo "Sorry, only CSV files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            echo "PLEASE GO BACK AND REFRESH THE PAGE!";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>