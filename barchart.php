<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/19/2016
 * Time: 1:42 PM
 * barchart.php
 * Data Visualization - Barchart
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
<script src="js/d3.v3.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script>
    var margin = {top: 20, right: 20, bottom: 70, left: 40},
        width = 600 - margin.left - margin.right,
        height = 300 - margin.top - margin.bottom;
    // Parse the date / time
    var	parseDate = d3.time.format("%Y-%m").parse;
    var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);
    var y = d3.scale.linear().range([height, 0]);
    var xAxis = d3.svg.axis()
        .scale(x)
        .orient("bottom")
        .tickFormat(d3.time.format("%Y-%m"));
    var yAxis = d3.svg.axis()
        .scale(y)
        .orient("left")
        .ticks(10);
    var svg = d3.select("body").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
        "translate(" + margin.left + "," + margin.top + ")");
    d3.csv("dat/barchart.csv", function(error, data) {
        data.forEach(function(d) {
            d.date = parseDate(d.date);
            d.value = +d.value;
        });

        x.domain(data.map(function(d) { return d.date; }));
        y.domain([0, d3.max(data, function(d) { return d.value; })]);
        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis)
            .selectAll("text")
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", "-.55em")
            .attr("transform", "rotate(-90)" );
        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 6)
            .attr("dy", ".71em")
            .style("text-anchor", "end")
            .text("Value ($)");
        svg.selectAll("bar")
            .data(data)
            .enter().append("rect")
            .style("fill", "steelblue")
            .attr("x", function(d) { return x(d.date); })
            .attr("width", x.rangeBand())
            .attr("y", function(d) { return y(d.value); })
            .attr("height", function(d) { return height - y(d.value); });
    });
</script>
</div>
</div>
<!-- /.row -->
<!-- Footer -->

<footer>
		<p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>

</footer>

</body>

</html>
