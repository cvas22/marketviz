<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/19/2016
 * Time: 1:42 PM
 * doughnut.php
 * Data Visualization - Doughnut chart
 */
include('verify.php');
?>
<!DOCTYPE html>
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
    <!-- Set Scalable Vector Graphics Parameters -->
    svg {
        font: 10px sans-serif;
    }

    .y.axis path {
        display: none;
    }

    .y.axis line {
        stroke: #fff;
        stroke-opacity: .2;
        shape-rendering: crispEdges;
    }

    .y.axis .zero line {
        stroke: #000;
        stroke-opacity: 1;
    }

    .title {
        font: 300 78px Helvetica Neue;
        fill: #666;
    }

    .birthyear,
    .age {
        text-anchor: middle;
    }

    .birthyear {
        fill: #fff;
    }

    rect {
        fill-opacity: .6;
        fill: #e377c2;
    }

    rect:first-child {
        fill: #1f77b4;
    }

</style>
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

<script src="//d3js.org/d3.v3.min.js"></script>
<script>

    var width = 960,
        height = 500,
        radius = Math.min(width, height) / 2;

    var color = d3.scale.ordinal()
        .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

    var arc = d3.svg.arc()
        .outerRadius(radius - 10)
        .innerRadius(radius - 70);

    var pie = d3.layout.pie()
        .sort(null)
        .value(function(d) { return d.sales; });

    var svg = d3.select("body").append("svg")
        .attr("width", width)
        .attr("height", height)
        .append("g")
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    d3.csv("dat/doughnut.csv", type, function(error, data) {
        if (error) throw error;

        var g = svg.selectAll(".arc")
            .data(pie(data))
            .enter().append("g")
            .attr("class", "arc");

        g.append("path")
            .attr("d", arc)
            .style("fill", function(d) { return color(d.data.ops); });

        g.append("text")
            .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
            .attr("dy", ".35em")
            .text(function(d) { return d.data.ops; });
    });

    function type(d) {
        d.sales = +d.sales;
        return d;
    }

</script>
<footer>
    <p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>

</footer>
</body>
