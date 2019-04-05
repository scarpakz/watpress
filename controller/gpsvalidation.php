<?php
include 'db.php';

//GET STATUS = 0
$getRequest = "SELECT * FROM tbl_location_request WHERE status = 0";
$execGetRequest = mysqli_query($db, $getRequest);

//Temporary Storage for pending request
$id = "";
$locationName = "";
$latitude = "";
$longitude = "";

//Fetch
while($row = mysqli_fetch_array($execGetRequest)){
  $id = $row['id'];
  $locationName = $row['location_name'];
  $latitude = $row['latitude'];
  $longitude = $row['longitude'];
}
?>
