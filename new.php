<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/19/2016
 * Time: 1:42 PM
 * NEW.PHP
 * Allows user to create a new entry in the database
*/

 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($username, $email, $password, $phone, $error)
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
         <div>
             <table>
                 <tr>
                 <strong><td align="right">Username: *</strong>
                  <td align="left">  <input type="text" name="username" value="<?php echo $username; ?>" /><br/> </td>
                 </tr>

                 <tr>
             <strong><td align="right">Email: *</td></strong>
                     <td align="left"> <input type="text" name="email" value="<?php echo $email; ?>" /><br/> </td>

                 </tr>

                 <tr>
             <strong><td align="right">Password: *</td></strong>
                     <td align="left"> <input type="text" name="password" value="<?php echo $password; ?>" /> </td>

                 </tr>

                 <tr>
             <strong><td align="right">Phone: * </td> </strong>
                     <td align="left"> <input type="text" name="phone" value="<?php echo $phone; ?>" /><br/> </td>

                 </tr>
             </table>
             <p>* required</p>
             <input type="submit" name="submit" value="Submit">

         </div>
     </form>
	 <footer>
		<p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>
		</footer>
     </body>
     </html>
     <?php
 }

 // connect to the database
 include('connect1.php');

 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 {
     // get form data, making sure it is valid
     $username = mysqli_real_escape_string($conn,htmlspecialchars( $_POST['username']));
     $email = mysqli_real_escape_string($conn,htmlspecialchars($_POST['email']));
     $password = mysqli_real_escape_string($conn,htmlspecialchars($_POST['password']));
     $phone =  mysqli_real_escape_string($conn,htmlspecialchars($_POST['phone']));
     // check to make sure both fields are entered
     if ($username == '' || $email == '' || $password == '' || $phone == '' )
     {
         // generate error message
         $error = 'ERROR: Please fill in all required fields!';

         // if either field is blank, display the form again
         renderForm($username, $email, $password, $phone, $error);
     }
     else
     {
         // save the data to the database
         $password = sha1($password);
         $SQLQuery = "INSERT users SET username='$username', email='$email', password ='$password', phone = '$phone'";

         //echo $SQLQuery;
         $result = $conn->query($SQLQuery);

         if(!$result)
         {
             echo $SQLQuery;
             echo "<br> Query execution failed! Please check input parameters";
         }

         //once saved, redirect back to the view page
         header("Location: admin.php");
     }
 }
 else
     // if the form hasn't been submitted, display the form
 {
     renderForm('','','','','');
 }
?>