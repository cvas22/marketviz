<html>
<head>
<title>Market Viz</title>
<link rel="shortcut icon" href="img/shortcut.png">
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/small-business.css" rel="stylesheet">
<link href ="css/footer.css" rel="stylesheet">
</head>
<body background = "http://vvf.cms.digital-ridge.com/media/565007/Vilarpac_website_background.jpg">
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand" href="index.html">
        <img src="img/logo.png" alt="">
        </a>
            
    <!-- Collect the nav links, forms, and other content for toggling -->
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
             <li>
                 <a href="contact.html">Contact</a>
             </li>
			<li>
                 <a href="admin.php">Admin</a>
            </li>
		</ul>
				
     </div>
<!-- /.navbar-collapse -->
</div>
</nav>

<p> you have suceessfully signed up! </p>
<?php
include('connect.php');
if (empty($_POST['user']) || empty($_POST['email']) || empty($_POST['pwd'])) {
	header("location:signup.html");
}
$userName = $_POST['userName'];
$pwd = sha1($_POST['pwd']);
$email = $_POST['emailName'];
$phone = $_POST['phone'];

$sql ="INSERT INTO users(username,password,email,phone) VALUES('$userName','$pwd','$email','$phone')";
echo $results = mysqli_query($link,$sql);
echo "HELLO";

echo(!$results?die($sql."<br>".mysqli_error($link)):"worked");
header("Location:index.html");
$msg = "User signup successful";
echo '<script type="text/javascript">alert("' . $msg . '")</script>';
?>
<footer>
     <p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>
</footer>
</body>
</html>