<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>DAYPLAN</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/head.php" ?>
    </head>

    <body id="main-page">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/header.php" ?>
        </header>

        <?php 
            if(!isset($_SESSION["user"]))
            header("location: /index.php");
        ?>

        <main>
            <div class="container">
                <div class="row profile">
                    <div class="col-md-3">
                        <div class="profile-sidebar" id="sidebar">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic text-center">

                                <?php if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/img/profile/" . $_SESSION["user"]->getLogin() . "/profile.jpg")): ?>
                                    <img src="/img/profile/<?php echo $_SESSION["user"]->getLogin() . "/profile.jpg"; ?>" alt="profile picture" class="img-circle img-responsive">
                                <?php else: ?>
                                    <img src="/img/a.jpg" alt="profile picture" class="img-circle img-responsive"> 
                                <?php endif; ?>

                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    <?php echo $_SESSION["user"]->getName(); ?>
                                </div>
                                <div class="profile-usertitle-job">
                                    <?php echo $_SESSION["user"]->getDepartment(); ?>
                                </div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <div class="profile-userbuttons">
                                <button type="button" class="btn btn-success btn-sm" id="send-button">SEND</button>
                                <button type="button" class="btn btn-danger btn-sm" id="erase-button">ERASE</button>
                            </div>
                            <!-- END SIDEBAR BUTTONS -->
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <ul class="nav" id="panel-menus">
                                    <li class="active">
                                        <a href="#" id="home">
                                        <i class="glyphicon glyphicon-home"></i>
                                        Home </a>
                                    </li>
                                    <li>
                                        <a href="#" id="profile">
                                        <i class="glyphicon glyphicon-user"></i>
                                        Profile </a>
                                    </li>
                                    <li>
                                        <a href="#" id="lastDayplan">
                                        <i class="glyphicon glyphicon-ok"></i>
                                        Last dayplan </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                        <i class="fa fa-clock-o" id="time"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <p id="sended-dayplan" hidden><?php echo $_SESSION["dayplan"]["dateplan"]; ?></p>

                            <!-- END MENU -->
                        </div>
                    </div>
                    <div class="col-md-9" id="editor-container">
                        <div class="profile-content">
                           <textarea name="editor" id="editor"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
