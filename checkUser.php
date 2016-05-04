<?php
include('connect.php');
if(empty($_GET['userName']) ){
	die("0");
}
$userName = $_GET['userName'];
$sql = "SELECT id FROM users WHERE username='$userName'";
//echo $sql;
$results = mysqli_query($link,$sql);
echo (!$results?die($sql."<br>".mysqli_error($link)):"");
$count = mysqli_num_rows($results);
if($count>0){
	echo 1;//username is not available; 
}else{
	echo 2;//username is available;
}
?>