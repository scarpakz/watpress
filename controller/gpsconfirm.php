<?php
include '../db.php';
session_start();
//Receive 2 datas
$data = $_POST['value'];
//split_data length is 2
//Index 0 is the location Id and Index 1 is for changes 1 or 0
$split_data = explode("?confirm=", $data);

//Update Status to 1 in Database
$updateQuery = "UPDATE tbl_location_request SET status = ".$split_data[1]." WHERE id =".$split_data[0]." ";
$execUpdate = mysqli_query($db, $updateQuery);

//===============SQL CONFIG HERE
$locationName = "";
$latitude = "";
$longitude = "";
$status = "";

//GET STATUS OF 1
$getLocationQuery = "SELECT * FROM tbl_location_request WHERE id =".$split_data[0]." ";
$execLoationQuery = mysqli_query($db, $getLocationQuery);
while($row = mysqli_fetch_array($execLoationQuery)){
  $locationName = $row['location_name'];
  $latitude = $row['latitude'];
  $longitude = $row['longitude'];
  $status = $row['status'];
}
$admin_username = $_SESSION['username'];
$admin_id = "";
//Get Admin ID
$getAdminId = "SELECT * FROM tbl_admin WHERE username = '$admin_username'";
$execGetAdminId = mysqli_query($db, $getAdminId);
while($row_admin = mysqli_fetch_array($execGetAdminId)){
  $admin_id = $row_admin['id'];
}

//insert status if updated
$insertNewLocationQuery = "INSERT INTO tbl_location (addedby_adminID, locationName, lat, lon, dateModified) VALUES('$admin_id','$locationName','$latitude','$longitude',NOW())";
$execInsertNewLocation = mysqli_query($db, $insertNewLocationQuery);

echo "
  <script>
    alert('Successfully added to map!');
    window.location.href='../main.php';
  </script>
";

?>
