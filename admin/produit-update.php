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

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/ui/prism.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/file-uploaders/dropzone.css">

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users list start -->
            <section class="users-list-wrapper">
                <!-- users filter start -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">livraison </h4>
                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="users-list-filter">
                            <?php   
                            if (isset($_GET['id'])){
                                $id= $_GET['id']; 
                                $sql = "SELECT * FROM produit WHERE `id`='$id'";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                        $id= $row["id"];
                                    ?>                                                       
                                <form method="post" enctype="multipart/form-data" class="dropzone dropzone-area">                             
                                <div class="form-group">
                                    <div class="controls">
                                        <label>titre</label>
                                        <input type="text" name="titre"  class="form-control" placeholder="Titre" value='<?php echo  utf8_encode($row["titre"]); ?>' required data-validation-required-message="This name field is required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <label>prix</label>
                                        <input type="number" name="prix"  class="form-control" placeholder="prix" value='<?php echo  $row["prix"]; ?>' required data-validation-required-message="This name field is required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>contenu</label>
                                    <fieldset class="form-label-group mb-0">
                                        <textarea name="contenu" data-length=2500  class="form-control char-textarea" id="textarea-counter" rows="3" placeholder="ecrir .."><?php echo utf8_encode($row["contenu"]); ?></textarea>
                                    </fieldset>
                                    <small class="counter-value float-right"><span class="char-count">0</span> / 2500 </small>
                                </div> 
                                <div class="form-group">
                                    <label>Description</label>
                                    <fieldset class="form-label-group mb-0">
                                        <textarea name="Description" data-length=2500  class="form-control char-textarea" id="textarea-counter" rows="3" placeholder="ecrir .."><?php echo utf8_encode($row["Description"]); ?></textarea>
                                    </fieldset>
                                    <small class="counter-value float-right"><span class="char-count">0</span> / 2500 </small>
                                </div>                                 
                                <div class="form-group">
                                <label>Specification</label>
                                    <fieldset class="form-label-group mb-0">
                                        <textarea name="Specification" data-length=2500  class="form-control char-textarea" id="textarea-counter" rows="3" placeholder="ecrir .."><?php echo utf8_encode($row["Specification"]); ?></textarea>
                                    </fieldset>
                                    <small class="counter-value float-right"><span class="char-count">0</span> / 2500 </small>
                                </div> 
                                    <div class="form-group">
                                    <div class="controls  mt-20">
                                        <input type="file" name="image" >
                                    </div>
                                </div>      
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                <button type="submit" name='sub' class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Sauvegarder les modifications</button>
                                    <button type="reset" class="btn btn-outline-warning">Réinitialiser</button>
                                </div>
                            
                            </form>
                            <?php  
                        
                        if (isset($_REQUEST['sub'])){
                            $id= $_GET['id']; 
                           
                            $dossier = 'assets/img/produit/';
                            $fichier = basename($_FILES['image']['name']);
                            move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier);
                            // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                            $titre = stripslashes(utf8_decode($_REQUEST['titre']));
                            $titre = mysqli_real_escape_string($conn, $titre);                           
                             // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                            $contenu = stripslashes(utf8_decode($_REQUEST['contenu']));
                            $contenu = mysqli_real_escape_string($conn, $contenu);
                            // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                            $Description = stripslashes(utf8_decode($_REQUEST['Description']));
                            $Description = mysqli_real_escape_string($conn, $Description);                           
                            // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                            $Specification = stripslashes(utf8_decode($_REQUEST['Specification']));
                            $Specification = mysqli_real_escape_string($conn, $Specification);
                            // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                            $prix = stripslashes($_REQUEST['prix']);
                            $prix = mysqli_real_escape_string($conn, $prix);
                                                            
                            $query = "UPDATE `produit` SET  `titre`= '$titre',`prix`= '$prix', `contenu`='$contenu' ,`Description`= '$Description', `Specification`='$Specification' WHERE `id`='$id'";
                            $result = mysqli_query($conn, $query);
                            if ($fichier <> '') {
                                    $query = "UPDATE `actualite` SET  `titre`= '$titre',`prix`= '$prix', `contenu`='$contenu' ,`Description`= '$Description', `Specification`='$Specification',`url-img`= '$dossier', `nom-img`= '$fichier' WHERE `id`='$id'";
                                    $result = mysqli_query($conn, $query);                               
                              

                            }
                            header('location: produit.php');

                        } }}?> 



                            </div>
                        </div>
                    </div>
                </div>
                <!-- users filter end -->
            </section>
            <!-- users list ends -->
        </div>
    </div>
</div>
<!-- END: Content-->



<div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">© Copyrights 2022 ADF Biomedical</span>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <script src="app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/datatables/datatable.js"></script>
    <!-- END: Page JS-->
        <!-- BEGIN: Page Vendor JS-->
        <script src="app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="app-assets/vendors/js/ui/prism.min.js"></script>
    <!-- END: Page Vendor JS-->    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/extensions/dropzone.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>