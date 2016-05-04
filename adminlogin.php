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
<style>

    body {

    }

    .axis path,
    .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
    }

</style>

<script src="http://cdnjs.cloudflare.com/ajax/libs/d3/3.4.13/d3.min.js"></script>


<body background = "http://vvf.cms.digital-ridge.com/media/565007/Vilarpac_website_background.jpg">
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand" href="process_login.php">
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

<form action="" method="post" name="admin_Form">
    <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
        <tr>
            <td colspan="2" align="left" valign="top"><h3>Login</h3></td>
        </tr>
        <tr>
            <td align="right" valign="top">Username</td>
            <td><input name="adminUsername" type="text" class="Input"></td>
        </tr>
        <tr>
            <td align="right">Password</td>
            <td><input name="adminPassword" type="password" class="Input"></td>
        </tr>
        <tr>
            <td> </td>
            <td><input name="Submit" type="submit" value="Login" class="Button3"></td>
        </tr>
    </table>
</form>

<?php
// Start session
session_start();

// Username and password
$ID = "admin";
$pass = "admin";

if (isset($_POST["adminUsername"]) && isset($_POST["adminPassword"])) {

    if ($_POST["adminUsername"] === $ID && $_POST["adminPassword"] === $pass) {

        $_SESSION["inloggedin"] = true;

        header("Location: admin.php");
        exit;
    }
    // Wrong login - message
    else {$wrong = "Bad ID and password, the system could not log you in";}
}
?>