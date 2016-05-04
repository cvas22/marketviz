<html>
<head>
<title>Market Viz</title>
<link rel="shortcut icon" href="img/shortcut.png">
<!-- Bootstrap Core CS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/small-business.css" rel="stylesheet">
<link href ="css/footer.css" rel="stylesheet">

</head>
<body background = "imgVilarpac_website_background.jpg">
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
                 <a href="adminlogin.php">Admin</a>
            </li>
		</ul>
				
     </div>
<!-- /.navbar-collapse -->
</div>
</nav>

<?php
include('connect.php');
//.. tells php comiler to go one folder above and look for secret.php
include("../secret.php");
if(empty($_POST['userName']) || empty($_POST['pwd'])){
	header("location:index.html");
}
$pwd = sha1($_POST['pwd']);
$user = $_POST['userName'];

$sql = "SELECT id, email FROM users WHERE username='$user' AND password='$pwd'";
//echo $sql;
$results = mysqli_query($link,$sql);
echo (!$results?die($sql."<br>".mysqli_error($link)):"");
$count = mysqli_num_rows($results);
if($count>0){
	$array = mysqli_fetch_array($results);
	$id = $array[0];
	$email = $array[1];
	//time() gets the current unix timestamp; 
	//what is unix timestamp? It is the time difference in seconds since 1st Jan 1970
	$time = time();
	/*
	1st parameter is the cookie variable name
	2nd parameter is the value that this cookie variable stores
	3rd parameter is the time till this cookie will last
	Note: if you do not specify the expiration time of a cookie then it is called non-persistent cookie; if you specify the expiration time then it is called persistent cookie; 
	*/
	//we need to add $status while creating hash so that if a user were to change the cookie valur for status then you can detect that. You do not want a user to change the value of status to 2 and become an admin. 
	$hash = sha1($email.$time.$id.$secret.$user);
	setcookie("email", $email,strtotime("+2 years"));
	setcookie("time", $time,strtotime("+2 years"));
	setcookie("id",$id,strtotime("+2 years"));
	setcookie("hash", $hash, strtotime("+2 years"));
	setcookie("name", $user, strtotime("+2 years"));

	if(!empty($_COOKIE['prevLocation'])){
		$prevLocation = $_COOKIE['prevLocation'];
		//expire the previous locatin cookie
		setcookie('prevLocation',"",strtotime('-1 day'));
		header("location:$prevLocation");
	}
}
else{
	header("location:index.html");
	}

?>
<h5>
<?php
	echo "Welcome $user !"?>
</h5>
<hr>
 <div class="col-lg-12">
	<div class="well text-center">
	<h4> Please choose the type of visualization from below</h4>
	</div>
</div>
<div class="row">

		<div class="row">
            <div class="col-md-4">
                <a href ="barchart.php">
                <img src = "img/bar_chart_web2.png" >
				</a>
            </div>
            <!-- /.col-md-4 -->
            <div class="col-md-4">
               <a href ="doughnut.php">
              <img src ="img/1416610556_pie-chart.jpg">
			  </a>
            </div>
            <!-- /.col-md-4 -->
            <div class="col-md-4">
                <a href ="linechart.php">
              <img src ="img/line3.gif">
			  </a>
            </div>
</div>
<hr>
<div class="row">
            <div class="col-md-4">
                <a href ="DivergingStackedBar.php">
              <img src ="img/thumbnail.png">
			  </a>
            </div>

			<div class="col-md-4">
                <a href ="chorddiagram.php">
              <img src = "img/Talent_chart_chord_chart_excel_01.png">
			  </a>
            </div>

			<div class="col-md-4">
                <a href ="multiline.php">
              <img src ="img/c.PNG" width ="350" height ="225">
			  </a>
            </div>
          </div>  <!-- /.col-md-4 -->
        </div>
		</div>
<footer>
     <p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>
</footer>
</body>
</html>