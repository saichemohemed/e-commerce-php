<?php  
    require('../config/config.php');
    ob_start();
    session_start();

?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="PIXINVENT">
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/ico" href="app-assets/images/logo/logo.png" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="app-assets/images/pages/login.png" alt="branding logo">
                                </div>


                                <?php

                                    if (isset($_POST['email'])){
                                        $email = stripslashes($_REQUEST['email']);
                                        $email = mysqli_real_escape_string($conn, $email);
                                        $_SESSION['email'] = $email;
                                        
                                        $mot_de_passe = stripslashes($_REQUEST['mot_de_passe']);
                                        $mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);
                                        $query = "SELECT * FROM `admin` WHERE email='$email' and mot_de_passe='".hash('sha256', $mot_de_passe)."'";
                                        $result = mysqli_query($conn,$query) or die(mysql_error());
                                           $_SESSION['email'] ;
                                        if (mysqli_num_rows($result) == 1) {
                                        
                                                header('location: les-commandes.php');
                                        
                                        }else{                                    

                                        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                                        }
                                    }
                                    ?>

                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Connexion</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">Bienvenue à nouveau, veuillez vous connecter à votre compte.</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form  method="post">
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input type="text" class="form-control"  name="email" placeholder="email"required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Email</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input type="password" class="form-control" name="mot_de_passe" placeholder="Mot de passe" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Mot de passe</label>
                                                    </fieldset>
                                                    <div class="form-group d-flex justify-content-between align-items-center">

                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-primary float-right btn-inline">Connexion</button>
                                                </form>
                                            </div>
                                        </div>
                                        <br>
                                        <?php if (! empty($message)) { ?>
                                            <p class="errorMessage"><?php echo $message; ?></p>
                                        <?php } ?>
                                        <div class="login-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <script src="app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>