<?php
  include '../db.php';

  //GET PRESSURE AND FLOW RATE
  $pressureExceeds = 10000;

  $data = array(
    "id" => array(),
    "loc_id" =>array(),
    "pressure" =>array(),
    "waterflow" =>array(),
    "lat" => array(),
    "lon" => array()
  );

  $getData = "SELECT tbl_rates.id, tbl_rates.locationID, tbl_rates.pressure, tbl_rates.waterflow, tbl_location.lat, tbl_location.lon FROM tbl_rates INNER JOIN tbl_location ON tbl_rates.locationID = tbl_location.id WHERE tbl_rates.pressure < $pressureExceeds AND tbl_rates.status = 0";
  $execGetData = mysqli_query($db, $getData);

  while($row = mysqli_fetch_array($execGetData)){
    array_push($data['id'], $row['id']);
    array_push($data['loc_id'], $row['locationID']);
    array_push($data['pressure'], $row['pressure']);
    array_push($data['waterflow'], $row['waterflow']);
    array_push($data['lat'], $row['lat']);
    array_push($data['lon'], $row['lon']);
  }

  echo json_encode($data, JSON_PRETTY_PRINT);
?>
