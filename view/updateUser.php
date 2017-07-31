<!DOCTYPE html>
<html lang="en">
<head>
    <title>DAYPLAN - ADMIN ZONE</title>
</head>

<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");

session_start();


if(isset($_POST["login"], $_POST["department"], $_POST["role"])){
    $login = $_POST["login"];
    $department = $_POST["department"];
    $role = $_POST["role"];

    $bbdd = DB::getInstance();

    $bbdd->stablishUTF8();

    $user = new User();

    $userDAO = new userDAO($user);

    $data = $userDAO->getUser($login);
}

if($_SESSION["user"]->getRole() == "admin"):

?>

<form action="/program/updateUser.php" method="post" class="form-horizontal">
    <fieldset>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">USERNAME</label>  
          <div class="col-md-4">
              <input id="login" name="login" type="text" placeholder="USERNAME" class="form-control input-md" value="<?php echo $data->getLogin(); ?>">
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
              <input id="name" name="name" type="text" placeholder="<?php echo $data->getName(); ?>" class="form-control input-md">
          </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
          <label class="col-md-4 control-label" for="surname">SURNAME</label>  
          <div class="col-md-4">
              <input id="surname" name="surname" type="text" placeholder="<?php echo $data->getSurname(); ?>" class="form-control input-md" required="">
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
              <input id="email" name="email" type="text" placeholder="<?php echo $data->getEmail(); ?>" class="form-control input-md" required="">
          </div>
      </div>

      <!-- Button -->
      <div class="form-group">
          <label class="col-md-4 control-label" for="singlebutton">Update user?</label>
          <div class="col-md-4">
            <button id="singlebutton" name="singlebutton" class="btn btn-primary">Yes</button>
        </div>
    </div>

</fieldset>
</form>
<?php endif; ?>
</html>