<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/19/2016
 * Time: 2:36 PM
 DELETE.PHP
 Deletes a specific entry from the 'players' table
*/

 // connect to the database
 include('connect1.php');

 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
     // get id value
     $id = $_GET['id'];

     // delete the entry
     $result = $conn->query("DELETE FROM users WHERE id=$id");
     if(!$result)
     {
          echo $SQLQuery;
          echo "<br> Query execution failed! Please check input parameters";
     }

     // redirect back to the view page
     header("Location: admin.php");
 }
 else
     // if id isn't set, or isn't valid, redirect back to view page
 {
     header("Location: admin.php");
 }

?>