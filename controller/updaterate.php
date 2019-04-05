<?php
include '../db.php';

//get from post
$get_rate_id = $_POST['data_id'];
$id = $get_rate_id['id'];


//exec query
$updateQuery = "UPDATE tbl_rates SET status = 1 WHERE id = '$id'";
$execUpdate = mysqli_query($db, $updateQuery);

echo json_encode($id, JSON_PRETTY_PRINT);
?>
