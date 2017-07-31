<!DOCTYPE html>
<html lang="en">
<head>
    <title>DAYPLAN - ADMIN ZONE</title>
</head>

<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

session_start();

if($_SESSION["user"]->getRole() == "admin"): 

?>

<form action="/program/insertUser.php" method="post" class="form-horizontal">
    <fieldset>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">USERNAME</label>  
          <div class="col-md-4">
              <input id="login" name="login" type="text" placeholder="USERNAME" class="form-control input-md" required>
          </div>
      </div>

      <!-- Password input-->
      <div class="form-group">
      <label class="col-md-4 control-label" for="pass">PASSWORD</label>  
          <div class="col-md-4">
              <input id="pass" name="pass" type="password" placeholder="PASSWORD" class="form-control input-md">
          </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
          <label class="col-md-4 control-label" for="name">NAME</label>  
          <div class="col-md-4">
              <input id="name" name="name" type="text" placeholder="NAME" class="form-control input-md">
          </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
          <label class="col-md-4 control-label" for="surname">SURNAME</label>  
          <div class="col-md-4">
              <input id="surname" name="surname" type="text" placeholder="SURNAME" class="form-control input-md" required="">
          </div>
      </div>

      <!-- Select input-->
      <div class="form-group">
          <label class="col-md-4 control-label" for="department">DEPARTMENT</label>  
          <div class="col-md-4">
              <select id="department" name="department" placeholder="placeholder" class="form-control input-md">
                  <option value="">SELECT DEPARTMENT</option>
                  <option value="it">IT</option>
                  <option value="sales">SALES</option>
                  <option value="hr">HR</option>
                  <option value="accounting">ACCOUNTING</option>
                  <option value="marketing">MARKETING</option>
                  <option value="ceo">CEO</option>
              </select>
          </div>
      </div>

      <!-- Select input-->
      <div class="form-group">
          <label class="col-md-4 control-label" for="role">ROLE</label>  
          <div class="col-md-4">
              <select id="role" name="role" placeholder="placeholder" class="form-control input-md">
                  <option value="">SELECT ROLE</option>
                  <option value="admin">ADMINISTRATOR</option>
                  <option value="supervisor">SUPERVISOR</option>
                  <option value="normal">NORMAL EMPLOYEE</option>
              </select>
          </div>
      </div>

      <!-- Email input-->
      <div class="form-group">
          <label class="col-md-4 control-label" for="email">EMAIL</label>  
          <div class="col-md-4">
              <input id="email" name="email" type="text" placeholder="EMAIL" class="form-control input-md" required="">
          </div>
      </div>

      <!-- Button -->
      <div class="form-group">
          <label class="col-md-4 control-label" for="singlebutton">Create user?</label>
          <div class="col-md-4">
            <button id="singlebutton" name="singlebutton" class="btn btn-primary">Yes</button>
        </div>
    </div>

</fieldset>
</form>
<?php endif; ?>
</html>