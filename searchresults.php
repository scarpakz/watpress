<?php include 'include/admin_header.php'; ?>
<?php if(isset($_SESSION['username'])){ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php
  $search_location = $_POST['searchlocation'];
  //GET Data
  $locationID = "";
  $location = "";

  $getLocationId = "SELECT * FROM tbl_location WHERE locationName = '$search_location'";
  $execLocQuery = mysqli_query($db, $getLocationId);
  while($row_id = mysqli_fetch_array($execLocQuery)){
    $locationID = $row_id['id'];
    $location = $row_id['locationName'];
  }
?>
<!-- rgba(131,186,214,1)
    rgba(197,203,206,1)-->
<div class="location-title">
  <div class="container">
    <center>
      <h2>WATER PRESSURE MONITORING </h2>
      <i class="material-icons">location_on</i> <h5 id="locationfetch"><?php echo $location;?></h5>
      <table border="1px">
        <thead>
          <th class="pressure_indicator">Pressure <hr></th>
          <th class="flow_indicator">Water flow rate <hr> </th>
        </thead>
        <tbody>
          <tr>
            <td><i id="psi"></i> PSI</td>
            <td><i id="flow"></i> Liter/min</td>
          </tr>
        </tbody>
      </table>
    </center>
  </div>
</div>
<div class="display-date">
  <div class="container">
    <center>
      <h5><b>Date:</b> <i><?php echo date('M d, Y');?></i> <i id="timeJS"></i> </h5>
      <h5> <b>X-Axis: </b>Time, <b>Y-Axis: </b>Value </h5>
    </center>
  </div>
</div>
<div class="chartContainer" style="height: 300px; width: 100%;">
  <br>
  <!-- <canvas id="" width="1000px" height="500"></canvas> -->
  <div id="chart">

  </div>

  
</div>

<?php include 'include/testfooter.php';?>
<?php //include 'include/admin_footer.php'; ?>
<!-- else end -->
<?php } else { ?>
  <script type="text/javascript">
    alert("You don't a permission to access this page!");
    window.location.href="index.php";
  </script>
<?php } ?>
