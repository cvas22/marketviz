<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/15/2016
 * Time: 11:28 AM
 *
 * Editor for the user column
 * Allows user to edit specific user entry in database
*/

 // creates the edit record form
 function createForm($id, $username, $email, $password, $phone, $error)
 {
     ?>
     <!DOCTYPE HTML>
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
     
     
     <?php
     // if there are any errors, display them
     if ($error != '')
     {
         echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
     }
     ?>



     <form action="" method="post">
         <input type="hidden" name="id" value="<?php echo $id; ?>"/>
         <div>
            <table>
                <tr><strong><td align="right">Userid:</strong></td> <td align="left"><?php echo $id; ?></td></tr>
                <tr><strong><td align="right">Username:</strong></td> <td align="left"><input type="text" align="left" name="username" value="<?php echo $username; ?>"/></td></tr><br/>
                <tr><strong><td align="right">E-mail:</strong></td> <td align="left"><input type="text" align="left" name="email" value="<?php echo $email; ?>"/></td></tr><br/>
                <tr><strong><td align="right">Password:</strong></td> <td align="left"><input type="text" align="left" name="password" value="<?php echo $password; ?>"/></td></tr><br/>
                <tr><strong><td align="right">Phone:</strong></td> <td align="left"><input type="text" align="left" name="phone" value="<?php echo $phone; ?>"/></td></tr><br/>
            </table>
                <input type="submit" name="submit" value="Submit">

         </div>
     </form>
	 </body>
     </html>
     <?php
 }


 // connect to the database
 include('connect1.php');

 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 {
     // confirm that the 'id' value is a valid integer before getting the form data
     if (is_numeric($_POST['id']))
     {
         // get form data, making sure it is valid
         $id = $_POST['id'];
         $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
         $email = mysqli_real_escape_string($conn,htmlspecialchars($_POST['email']));
         $password = mysqli_real_escape_string($conn,htmlspecialchars($_POST['password']));
         $phone = mysqli_real_escape_string($conn,htmlspecialchars($_POST['phone']));

         // check that firstname/lastname fields are both filled in
         if ($username == '' || $email == '' || $password == '' || $phone == '')
         {
             // generate error message
             $error = 'Please fill in all required fields!';
             //error, re-display display form
             createForm($id, $username,  $email, $password, $phone , '');
         }
         else
         {
             // save the data to the database
             $SQLQuery = "UPDATE users SET username='$username', email='$email', password='$password', phone='$phone' WHERE id='$id' ";
             $result = $conn->query($SQLQuery);
             if(!$result)
             {
                 echo $SQLQuery;
                 echo "<br> Query execution failed! Please check input parameters";
             }
             // once saved, redirect back to the view page
             header("Location: admin.php");
         }
     }
     else
     {
         // if the 'gd_id' isn't valid, display an error
         echo 'Invalid id! POST';
         echo $_POST['id'];
     }
 }
 else
     // if the form hasn't been submitted, get the data from the db and display the form
 {
     // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
     if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
     {
         // query db
         $id = $_GET['id'];
         $result = $conn->query("SELECT * FROM users WHERE id=$id");
         $row = mysqli_fetch_array($result);

         // check that the 'id' matches up with a row in the databse
         if($row)
         {
           // get data from db
             $username = $row['username'];
             $email = $row['email'];
             $password = $row['password'];
             $phone = $row['phone'];
             $error = '';
             // show form
             createForm($id,  $username, $email, $password, $phone, $error);
         }
         else
             // if no match, display result
         {
             echo "No results for that id";
         }
     }
     else
         // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
     {
         echo "Invalid id! GET!";
     }
 }
?>