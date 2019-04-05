<?php
include '../db.php';

// Admin login
session_start();

    // Get Admin Input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Temp storage
    $temp_username = "";
    $temp_password = "";

    // Fetch admin credentials
    $getCredentials = "SELECT * FROM tbl_admin";
    $execGetCredentials = mysqli_query($db, $getCredentials);
    while($row = mysqli_fetch_array($execGetCredentials)){
      $temp_username = $row['username'];
      $temp_password = $row['password'];
    }
    if(($temp_username == $username) && ($temp_password == $password)){
      $_SESSION['username'] = $username;
      $_SESSION['password'] = $password;
      echo "
        <script>window.location.href='../main.php'</script>
      ";
    }else{
      echo "
        <script>window.location.href='../view_error.php'</script>
      ";
    }

?>
