
<?php include 'include/admin_header.php';?>
  <div class="changepassword">
    <div class="container">
      <div class="row">
        <br>
        <h3>Settings</h3>
        <hr><br>
        <div class="col s6">
          <form action="controller/admin_settings.php" method="post">
            <div class="input-field">
              <input type="password" name="oldPassword" required>
              <label for="">Old Password</label>
            </div>
            <div class="input-field">
              <input id="newPassword" type="password" name="newPassword" required>
              <label for="">New Password</label>
            </div>
            <div class="input-field">
              <input id="confirmPassword" type="password" name="" required>
              <label for="">Confirm Password</label>
            </div>
              <input type="submit" class="btn waves-effect" value="Save">
            <div class="row">
              <p id="errorCompare" style="color: red"></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php include 'include/admin_footer.php';?>
