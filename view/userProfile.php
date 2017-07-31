<?php

    include_once($_SERVER["DOCUMENT_ROOT"] . "/model/bd.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/model/user.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/dao/userdao.php");
    include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/userController.php");
    include_once $_SERVER['DOCUMENT_ROOT'] . "/view/errors.php";

    session_start(); 

?>

<div class="container" id="user-profile">
    <div class="row">

     <div class="col-md-8 ">

        <div class="panel panel-primary">
          <div class="panel-heading">  <h4 >User Profile</h4></div>
          <div class="panel-body">

            <div class="box box-info">

                <div class="box-body">
                   <div class="col-sm-6">
                       <div align="center"> 

                            <?php if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/img/profile/" . $_SESSION["user"]->getLogin() . "/profile.jpg")): ?>
                                <img src="/img/profile/<?php echo $_SESSION["user"]->getLogin() . "/profile.jpg"; ?>" alt="profile picture" class="img-circle img-responsive" id="profile-image">
                            <?php else: ?>
                                <img src="/img/a.jpg" alt="profile picture" class="img-circle img-responsive" id="profile-image"> 
                            <?php endif; ?>

                            <form action="/program/profilePicture.php" method=POST id="profile-img-user" enctype=multipart/form-data>
                                <input id="profile-image-upload" class="hidden" type="file" name="upload">
                                <div style="color:#999;">click to change the image</div>         
                            </form>
                        </div>
                    <br>

                    <!-- /input-group -->
                </div>
                <div class="col-sm-6 text-center">
                <h3 style="color:#00b1b1;"><?php echo $_SESSION["user"]->getName() . " " . $_SESSION["user"]->getSurname(); ?> </h3></span>
                    <h5 class="text-center"><p><a href="mailto:<?php echo $_SESSION["user"]->getEmail(); ?>"><?php echo $_SESSION["user"]->getEmail(); ?></a></p></h5>            
                </div>
                <div class="clearfix"></div>
                <hr style="margin:5px 0 5px 0;">


                <div class="col-sm-5 col-xs-6 tital " >Name:</div><div class="col-sm-7 col-xs-6 "><?php echo $_SESSION["user"]->getName();?></div>
                <div class="clearfix"></div>
                <div class="bot-border"></div>

                <div class="col-sm-5 col-xs-6 tital " >Surname:</div><div class="col-sm-7"><?php echo $_SESSION["user"]->getSurname();?></div>
                <div class="clearfix"></div>
                <div class="bot-border"></div>

                <div class="clearfix"></div>
                <div class="bot-border"></div>

                <div class="col-sm-5 col-xs-6 tital " >Department:</div><div class="col-sm-7"><?php echo $_SESSION["user"]->getDepartment();?></div>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>

    </div> 
</div>
</div>  

</div>
</div>


<script>
    
    //Profile picture
    $('#profile-image').on('click', function() {
        $('#profile-image-upload').click();

        $('#profile-image-upload').on("change", function(){
            //var file = $('input[type=file]').val();
            //var filename = $('input[type=file]').val().replace(/C:\\fakepath\\/i, '');

            $("#profile-img-user").submit();
        });
    });

</script>
