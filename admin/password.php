<?php
require('../config/config.php');
session_start();
if(!isset($_SESSION["email"])){
    header("Location: login.php");
    exit(); 
}
require('_css.php');
require('Header.php');
require('Menu.php');
$_SESSION["msg"]= '';
?>

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="true">

                                    <i class="feather icon-lock mr-50 font-medium-3"></i>
                                    Changer le mot de passe
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <?php

                        if (isset($_POST['sub'])) {
                            // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                            $pass = stripslashes($_REQUEST['pass']);
                            $pass = mysqli_real_escape_string($conn, $pass);
                            // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                            $pass1 = stripslashes($_REQUEST['pass1']);
                            $pass1 = mysqli_real_escape_string($conn, $pass1);
                            // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                            $pass2 = stripslashes($_REQUEST['pass2']);
                            $pass2 = mysqli_real_escape_string($conn, $pass2);

                            if ($pass1 === $pass2) {
                                    
                                    $sql = "SELECT *  FROM admin";                                   
                                    $result = mysqli_query($conn, $sql);

                                    while($row = mysqli_fetch_assoc($result)) {
                                        $pass3 = $row["mot_de_passe"];

                                        if (hash('sha256', $pass) === $pass3) {
                                            $pas=hash('sha256', $pass2);
                                            if ($_SESSION['role'] == 'admin') {
                                                $query = "UPDATE `admin` SET mot_de_passe ='$pas'";
                                                mysqli_query($conn, $query);
                                                header('location: profile.php');
                                            }else {
                                                $query = "UPDATE `admin` SET mot_de_passe ='$pas'";
                                                mysqli_query($conn, $query);
                                                header('location: profile.php');
                                            }

                                        }else {
                                            $_SESSION["msg"] ='Vérifiez que votre mot de passe doit être correct pour pouvoir le déverrouiller';
                                        }

                                    }

                            }else {
                                $_SESSION["msg"] ='Ces deux mots de passe sont différents';
                            }
                            
                        }
                        ?>




                        <!-- right content section -->
                    <div class="row">
                        <div class="container-fluid col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">

                                            <div class="tab-pane active" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="true">
                                                <form method="POST">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-old-password">Ancien mot de passe</label>
                                                                    <input type="password" name="pass" class="form-control" id="account-old-password" required placeholder="Old Password" data-validation-required-message="This old password field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-new-password">Nouveau mot de passe</label>
                                                                    <input type="password" name="pass1" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-retype-new-password">Re-taper le nouveau mot de passe</label>
                                                                    <input type="password" name="pass2" class="form-control" required id="account-retype-new-password" data-validation-match-match="password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" name='sub' class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Sauvegarder les modifications</button>
                                                            <button type="reset" class="btn btn-outline-warning">Réinitialiser</button>
                                                        </div>
                                                    </div>
                                                </form>  <br>                                                                                                  
                                                <p class="errorMessage" style="color: red;"><?php echo $_SESSION["msg"]; ?></p>

                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page end -->

            </div>
        </div>
    </div>
    <?php
    require('footer.php');
    ?>