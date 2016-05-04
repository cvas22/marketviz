<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/19/2016
 * Time: 1:42 PM
 * multiline.php
 * Data Visualization - Multiline chart
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

    body {

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
<body>
<!-- Navigation Bar -->
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

<script src="http://d3js.org/d3.v3.min.js"></script>
<script>

    var margin = {top: 60, right: 150, bottom: 30, left: 50},
        width = 960 - margin.left - margin.right,
        height = 540 - margin.top - margin.bottom;

    var parseDate = d3.time.format("%Y%m%d").parse;

    var x = d3.time.scale()
        .range([0, width]);

    var y = d3.scale.linear()
        .range([height, 0]);

    var color = d3.scale.category10();

    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom");

    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left");

    var line = d3.svg.line()
        .interpolate("basis")
        .x(function(d) { return x(d.date); })
        .y(function(d) { return y(d.stockprice); });

    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    d3.csv("dat/data3multi.csv", function(error, data) {
        if (error) throw error;

        color.domain(d3.keys(data[0]).filter(function(key) { return key !== "date"; }));

        data.forEach(function(d) {
            d.date = parseDate(d.date);
        });

        var cities = color.domain().map(function(name) {
            return {
                name: name,
                values: data.map(function(d) {
                    return {date: d.date, stockprice: +d[name]};
                })
            };
        });

        x.domain(d3.extent(data, function(d) { return d.date; }));

        y.domain([
            d3.min(cities, function(c) { return d3.min(c.values, function(v) { return v.stockprice; }); }),
            d3.max(cities, function(c) { return d3.max(c.values, function(v) { return v.stockprice; }); })
        ]);

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
            .text("Sales (/day)");

        var city = svg.selectAll(".city")
            .data(cities)
            .enter().append("g")
            .attr("class", "city");

        city.append("path")
            .attr("class", "line")
            .attr("d", function(d) { return line(d.values); })
            .style("stroke", function(d) { return color(d.name); });

        city.append("text")
            .datum(function(d) { return {name: d.name, value: d.values[d.values.length - 1]}; })
            .attr("transform", function(d) { return "translate(" + x(d.value.date) + "," + y(d.value.stockprice) + ")"; })
            .attr("x", 3)
            .attr("dy", ".35em")
            .text(function(d) { return d.name; });
    });

</script>
<footer>
    <p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>

</footer>