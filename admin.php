<html>
<head>

<link rel="shortcut icon" href="img/shortcut.png">
<title>Market Viz</title>
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




<h4>
<?php echo "LIST OF USERS";?>
</h4>
<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/15/2016
 * Time: 1:54 AM
 *
 * This php script is used to display and edit the data
 * in the user table.
 */

// connect to the database
include('connect1.php');
$SQLquery = "SELECT * FROM users";
$result = $conn->query($SQLquery);

// display data in table
//echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>id</th> <th>Username</th> <th>Email</th> <th>Password</th> <th>Phone</th> </tr>";

// loop through results of database query, displaying them in the table
while($row = mysqli_fetch_array($result)) {
// echo out the contents of each row into a table

echo "<tr>";
echo '<td>' . $row['id'] . '</td>';
echo '<td>' . $row['username'] . '</td>';
echo '<td>' . $row['email'] . '</td>';
echo '<td>' . $row['password'] . '</td>';
echo '<td>' . $row['phone'] . '</td>';
echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';
echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
echo "</tr>";
}
echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>

<footer>
     <p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>
</footer>
</body>
</html>
