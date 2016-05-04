<?php
/**
* Created by PhpStorm.
* User: Srinivas
* Date: 3/19/2016
* Time: 1:42 PM
* linechart.php
* Data Visualization - Line graph
*/
include('verify.php');
?>
<!DOCTYPE html>
<meta charset="utf-8">
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
        font: 10px sans-serif;
    }

    .axis path,
    .axis line {
        fill: none;
        stroke: #000;
        shape-rendering: crispEdges;
    }

    .x.axis path {
        display: none;
    }

    .line {
        fill: none;
        stroke: steelblue;
        stroke-width: 1.5px;
    }

</style>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Market Viz</title>

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Navigation -->
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
                    <a href="adminlogin.php">Admin</a>
                </li>
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>

<div class="upload">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select data file to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload" name="submit">
    </form>
</div>

<script src="js/d3.v3.min.js"></script>
<script>

    var margin = {top: 100, right: 100, bottom: 30, left: 50},
        width = 960 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    var formatDate = d3.time.format("%d-%b-%y");

    var x = d3.time.scale()
        .range([0, width]);

    var y = d3.scale.linear()
        .range([height, 0]);

    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left");

    var line = d3.svg.line()
        .x(function(d) { return x(d.date); })
        .y(function(d) { return y(d.close); });

    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    d3.csv("dat/linechart.csv", type, function(error, data) {
        if (error) throw error;

        x.domain(d3.extent(data, function(d) { return d.date; }));
        y.domain(d3.extent(data, function(d) { return d.close; }));

        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Closing Price ($)");

        svg.append("path")
            .datum(data)
            .attr("class", "line")
            .attr("d", line);
    });

    function type(d) {
        d.date = formatDate.parse(d.date);
        d.close = +d.close;
        return d;
    }

</script>

<footer>
    <p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>

</footer>
</body>