<?php
include '../db.php';

// GET DATA FROM VIEW
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];

// Temp storage for old password
$tempOldPass = "";

//GET OLD Password to compare
$oldPassQuery = "SELECT * from tbl_admin";
$execOldPass = mysqli_query($db, $oldPassQuery);
while($oldPassRow = mysqli_fetch_array($execOldPass)){
  $tempOldPass = $oldPassRow['password'];
}

if($tempOldPass == $oldPassword){
  // UPDATE ADMIN PASSWORD
  $updateQuery = "UPDATE tbl_admin SET password = '$newPassword', dateModified = NOW()";
  $execUpdate = mysqli_query($db, $updateQuery);
  echo "
    <script>
      window.location.href='../success.php';
    </script>
  ";
}

?>
