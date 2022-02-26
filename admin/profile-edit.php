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
                                    <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        Editer le profil 
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php  
                                    $sql = "SELECT * FROM admin";

                            $result = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($result)) {
                        ?>  

                        <?php

                            if (isset($_POST['sub'])) {

                                // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                                $nom = stripslashes($_REQUEST['nom']);
                                $nom = mysqli_real_escape_string($conn, $nom);
                                // récupérer l'prenom et supprimer les antislashes ajoutés par le formulaire
                                $prenom = stripslashes($_REQUEST['prenom']);
                                $prenom = mysqli_real_escape_string($conn, $prenom);
                                // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
                                $email = stripslashes($_REQUEST['email']);
                                $email = mysqli_real_escape_string($conn, $email);
                                // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
                                $date = stripslashes($_REQUEST['date']);
                                $date = mysqli_real_escape_string($conn, $date);                            
                                // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                                $addresse = stripslashes($_REQUEST['addresse']);
                                $addresse = mysqli_real_escape_string($conn, $addresse);                                
                                // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire

                                $dossier = 'app-assets/images/portrait/small/';
                                $fichier = basename($_FILES['image']['name']);
                                move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier);
                                $img = $row["nom-img"];

                                    $fichier == '' ? $fichier = $img  : $fichier = $fichier ;
                                    $query = "UPDATE `admin` SET `email`='$email', `prenom`='$prenom',`nom`='$nom', `date_de_naissance`='$date', `addresse`='$addresse', `url-img`='$dossier', `nom-img`='$fichier'";
                                    mysqli_query($conn, $query);
                                    $_SESSION["url-img"]= $dossier;
                                    $_SESSION["nom-img"]= $fichier;
                                    $_SESSION['nom']= $nom;
                                    $_SESSION['prenom']= $prenom;

                                    header('location: profile.php');
                                

                            }
                            ?>
  
                        <!-- right content section -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                            <form method="POST" enctype="multipart/form-data">
                                                 <div class="media">
                                                    <a href="javascript: void(0);">
                                                        <img src="<?php echo  $row["url-img"].$row["nom-img"];?>" class="rounded mr-75" alt="profile image" height="64" width="64">
                                                    </a>
                                                    <div class="media-body mt-75">
                                                        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer" for="account-upload">Télécharger une nouvelle photo</label>
                                                            <input type="file" id="account-upload" hidden name="image">
                                                            <button class="btn btn-sm btn-outline-warning ml-50">Réinitialiser</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">E-mail</label>
                                                                    <input type="email" name='email' class="form-control" id="account-e-mail" placeholder="Email" value="<?php echo  $row["email"];?>" required data-validation-required-message="This email field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Nom</label>
                                                                    <input type="text" name='nom' class="form-control" id="account-name" placeholder="Name" value="<?php echo  $row["nom"];?>" required data-validation-required-message="This name field is required">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="account-company">prenom</label>
                                                                <input type="text" name='prenom' class="form-control" id="account-company" placeholder="Email" value="<?php echo  $row["prenom"];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="account-company">addresse</label>
                                                                <input type="text" name='addresse' class="form-control" id="account-company" placeholder="Email" value="<?php echo  $row["addresse"];?>">
                                                            </div>
                                                        </div>                                                        
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">date de naissance</label>
                                                                    <input type="text" name='date' class="form-control" id="account-name" placeholder="Name" value="<?php echo  $row["date_de_naissance"];?>" required data-validation-required-message="This name field is required">
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" name='sub' class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Sauvegarder les modifications</button>
                                                            <button type="reset" class="btn btn-outline-warning">Réinitialiser</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php }?> 

                    </div>
                </section>
                <!-- account setting page end -->

            </div>
        </div>
    </div>
    <?php
    require('footer.php');
    ?>