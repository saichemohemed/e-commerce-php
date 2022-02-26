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
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
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
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/data-list-view.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-body">
                <!-- Data list view starts -->
                <section id="data-list-view" class="data-list-view-header">


                    <!-- DataTable starts -->
                    <div class="table-responsive">
                        <table class="table data-list-view">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom & Prenom</th>
                                    <th>Produit</th>
                                    <th>Montane</th>
                                    <th>Adresse De facturation</th>
                                    <th>Telephone</th>  
                                    <th>Etat</th> 
                                    <th>Date De livraison</th>
                                    <th>Action</th>                           
                                </tr>
                            </thead>
                            <tbody>
                            <?php    
                                    $query = "SELECT *, m.id AS idcommande , p.id AS idpanier FROM commande as m JOIN panier as p ON m.id = p.idcommande JOIN produit as pr ON p.idproduit = pr.id JOIN client as cl ON m.idclient = cl.id JOIN livraison as l ON m.id = l.idcommande WHERE  m.etat='acceptee'";
                                    $result = mysqli_query($conn, $query);

                                        while($row = mysqli_fetch_assoc($result)) {
                                ?>  
                                    <tr>
                                    <td class="product-category"><?php echo  $row["idcommande"];?></td>
                                        <td class="product-category"><?php echo  $row["nom"]. ' '. $row["prenom"];?></td>
                                        <td class="product-name"><?php echo  utf8_encode($row["titre"]);?></td>
                                        <td class="product-category"><?php echo  $row["montane"];?></td>
                                        <td class="product-category"><?php echo  $row["adresse-de-facturation"];?></td>
                                        <td class="product-category"><?php echo  $row["telephone"];?></td>
                                        <td>
                                            <div class="chip chip-success" style="width: 120%;">
                                                <div class="chip-body">
                                                    <div class="chip-text"><?php echo  $row["etat"];?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-category"><?php  echo $date = !empty($row["date_de_livraison"]) ?  $row["date_de_livraison"] : 'jj\mm\aaaa'?></td>
                                        <td class="product-action">
                                        <button name="sub" id="sub" class="btn sub"  value="<?php echo  $row["idcommande"]; ?>" style="padding: unset !important;"><i class="feather icon-check-square"></i></button>
                                        <a href="livraison-update.php?id=<?php echo $row["idcommande"]; ?>" ><button  class="btn"  style="padding: unset !important;"><i class="feather icon-edit-2"></i></button></a>
                                        </td>
                                    </tr>
                                <?php }?> 
                            </tbody>
                        </table>
                    </div>

                    <?php
                           
                           if (isset($_POST['sub'])){
                            $id = $_POST['id'];
                            $query="UPDATE `livraison` SET `etat`= 'terminer' WHERE `idcommande`='$id'";
                            mysqli_query($conn, $query);   
                        }
                       ?> 
                    <!-- DataTable ends -->
                </section>
                <!-- Data list view end -->

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
    <script src="app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <script src="app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/ui/data-list-view.js"></script>
    <!-- END: Page JS-->

    <script>
    $('.sub').on('click', function(){
        var id = $(this).val();
        //  alert(id);
			$.ajax({
				url: 'livraison.php',
				type: 'POST',
				data: {
					sub: 1,
                    id: id,

				},
				success: function(data){
                    document.location.reload();
				}
            });	
            });
</script>
</body>
<!-- END: Body-->

</html>