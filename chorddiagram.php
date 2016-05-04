<?php
include('verify.php');
?>

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
    </form><br>
</div>

<div id="figure" style="margin-bottom: 50px;"></div>


<script src="http://d3js.org/d3.v3.min.js"></script>
<script>

    var margin      = {top: 0, right: 10, bottom: 10, left: 50},
        width       = 860 - margin.left - margin.right,
        height      = 500 - margin.top  - margin.bottom,
        innerRadius = Math.min(width, height) * .35,
        outerRadius = innerRadius * 1.1;

    var svg = d3.select("body").append("svg")
        .attr("width",  width  + margin.left + margin.right)
        .attr("height", height + margin.top  + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
        .append("g")
        .attr("class", "chordgraph")
        .attr("transform", "translate(" + width/2 + "," + height/2 + ")");

    d3.csv("dat/ChordData.csv", function(d){

        /*
         * IMPORTANT! Specify your first column of data here (see example data)
         *
         */
        var firstColumn = "Months";

        //store coloumn names
        var fc = d.map(function(d){ return d[firstColumn]; }),
            fo = fc.slice(0),
            maxtrix_size = (Object.keys(d[0]).length - 1) + fc.length,
            matrix  = [];

        //Create an empty square matrix of zero placeholders, the size of the ata
        for(var i=0; i < maxtrix_size; i++){
            matrix.push(new Array(maxtrix_size+1).join('0').split('').map(parseFloat));
        }

        //go through the data and convert all to numbers except "first_column"
        for(var i=0; i < d.length; i++){

            var j = d.length;//counter

            for(var prop in d[i]){
                if(prop != firstColumn){
                    fc.push(prop);
                    matrix[i][j] = +d[i][prop];
                    matrix[j][i] = +d[i][prop];
                    j++;
                }
            }
        }

        var chord = d3.layout.chord()
            .padding(.1)
            .sortSubgroups(d3.descending)
            .matrix(matrix);

        var chordgroups = chord.groups()
            .map(function(d){ d.angle = (d.startAngle + d.endAngle)/2; return d; });

        var arc = d3.svg.arc()
            .innerRadius(innerRadius)
            .outerRadius(outerRadius);

        var fill = d3.scale.category10();

        svg.selectAll("path")
            .data(chord.groups)
            .enter()
            .append("path")
            .style("fill", function(d, i){ return (d.index+1) > fo.length ? fill(d.index): "#ccc";})
            .style("stroke", function(d, i) { return "#000"; })
            .style("cursor", "pointer")
            .attr("d", arc)
            .on("mouseover", function(d, i){
                chords.classed("fade", function(d){
                    return d.source.index != i && d.target.index != i;
                })
            });


        var chords = svg.append("g")
            .attr("class", "chord")
            .selectAll("path")
            .data(chord.chords)
            .enter()
            .append("path")
            //set the starting node. Change index from zero here.
            //to start with a target dataset, change d.source.index to d.target.index
            .classed("fade", function(d,i){return d.source.index == 0 ? false : true;})
            .attr("d", d3.svg.chord().radius(innerRadius))
            .style("fill", function(d) { return fill(d.source.subindex); })
            .style("stroke", function(d){ return "#000";});

        svg.selectAll(".text")
            .data(chordgroups)
            .enter()
            .append("text")
            .attr("class", "text")
            .attr("text-anchor", function(d) { return d.angle > Math.PI ? "end" : null; })
            .attr("transform", function(d){

                //rotate each label around the circle
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")" +
                    "translate(" + (outerRadius + 10) + ")" +
                    (d.angle > Math.PI ? "rotate(180)" : "");

            })
            .text(function(d,i){
                //set the text content
                return fc[i];
            })
            .style({
                "font-family":"sans-serif",
                "font-size"  :"12px"
            })

    });
</script>
<footer>
    <p><font color ="white"> Copyright &copy; Market Viz 2016 </font></p>

</footer>
</body>
</html>