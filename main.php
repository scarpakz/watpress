<?php include 'include/admin_header.php'; ?>
<?php if(isset($_SESSION['username'])){ ?>
<link rel="stylesheet" href="css/style.css">

        <div class="wp_main_legend">
            <div class="container">
                <h4>Legend</h4>
                <div class="row">
                    <div class="col s3"><h5><i><img src="images/icon_indicator/green_indicator.png"> </i>High Pressure</h5></div>
                    <div class="col s3"><h5><i><img src="images/icon_indicator/yellow_gif.png"> </i>Average Pressure</h5></div>
                    <div class="col s3"><h5><i><img src="images/icon_indicator/red_indicator_gif.png"> </i>Low Pressure</h5></div>
                    <div class="col s3"><h5><i><img src="images/icon_indicator/no_connection.png" height="50px" width="50px"> </i>No Signal</h5></div>
                </div>
                <hr>
            </div>
        </div>

        <!-- MAP OVERVIEW -->
        <div class="wp_main_map_overview">
            <div class="container">
                <!-- SEARCH -->
                <br>
                <br>
                <form action="searchresults.php" method="POST">
                  <select name="searchlocation">
                    <option disabled selected>Select Location</option>
                    <!-- <option value="searchresults.php">Lapasan</option> -->
                    <?php
                      //GET LOCATIONS
                      $fetchLocation = "SELECT * FROM tbl_location WHERE status = 0";
                      $execFetchlocation = mysqli_query($db, $fetchLocation);
                      while($loc_row = mysqli_fetch_array($execFetchlocation)){
                    ?>
                    <option value="<?php echo $loc_row['locationName'];?>"><?php echo $loc_row['locationName'];?></option>
                    <?php }?>
                  </select>
                  <input type="submit" value="Search" class="btn btn-wave">
                </form>
                <h4>Overview</h4>
                <div id="map">
                    <!-- MAP API HERE -->
                </div>
            </div>
        </div>

        <!-- SUMMARY -->
        <!-- <h1 style="text-align:center;">AREA MONITORING SUMMARY</h1>
        <div class="container">
            <div class="row">
                <center>
                <div id="graph" class="col s12">
                  <script>
                    var $container = jQuery('#graph');
                    var barcolors      = [ '#5cb51a', '#FF0000', '#fd5100', '#000000'],
                        highlightcolor = '#FFF68F',
                        lengendlabels  = ['High Pressure Area', 'Low Pressure Area', 'Average Pressure Area', 'Not Connected Area'],
                        data           = [8, 2, 3, 2];

                    var pheight = 700,
                        pwidth  = 870,
                        radius  = pwidth < pheight ? pwidth/3 : pheight/3;
                        bgcolor = jQuery('body').css('background-color');

                    var paper = new Raphael($container[0], pwidth, pheight);

                    // draw the piechart
                    var pie = paper.piechart(pwidth/2, pheight/2, radius, data, {
                      legend: lengendlabels,
                      legendpos: 'east',
                      legendcolor: '#000000',
                      stroke: bgcolor,
                      strokewidth: 8,
                      colors: barcolors
                    });

                    // assign the hover in/out functions
                    pie.hover(function () {
                      this.sector.stop();
                      this.sector.scale(1.1, 1.1, this.cx, this.cy);
                      this.sector.animate({ 'stroke': highlightcolor }, 400);
                      this.sector.animate({ 'stroke-width': 1 }, 500, "bounce");

                      if (this.label) {
                        this.label[0].stop();
                        this.label[0].attr({ r: 8.5 });
                        this.label[1].attr({ "font-weight": 1000 });
                        center_label.attr('text', this.value.value + '%');
                        center_label.animate({ 'opacity': 1.0 }, 200);
                      }
                      }, function () {
                        this.sector.animate({ transform: 's1 1 ' + this.cx + ' ' + this.cy }, 500, "bounce");
                        this.sector.animate({ 'stroke': bgcolor }, 400);
                        if (this.label) {
                          this.label[0].animate({ r: 5 }, 500, "bounce");
                          this.label[1].attr({ "font-weight": 400 });
                          //center_label.attr('text','');
                          center_label.animate({ 'opacity': 1.0 }, 500);
                        }
                    });

                    // blank circle in center to create donut hole effect
                    paper.circle(pwidth/2, pheight/2, radius*0.6)
                      .attr({'fill': bgcolor, 'stroke': bgcolor});

                    var center_label = paper.text(pwidth/2, pheight/2, '')
                      .attr({'fill': '#eaeaea', 'font-size': '40', "font-weight": 1000, 'opacity': 0.0 });

                  </script>
                </div>
            </div>
        </div> -->

        <div  class="wp_main_summary">
            <div class="container">

            </div>
        </div>
<?php include 'include/admin_footer.php'; ?>
<!-- else end -->
<?php } else { ?>
  <script type="text/javascript">
    alert("You don't a permission to access this page!");
    window.location.href="index.php";
  </script>
<?php } ?>
