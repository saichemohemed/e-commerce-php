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

                <!-- Column selectors with Export Options and print table -->
                <section id="column-selectors">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                <h4 class="card-title">les commandes</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                      
                                        <div class="table-responsive">
                                            <table class="table  dataex-html5-selectors ">
                                                <thead>
                                                    <tr>
                                                        <th>nom</th>
                                                        <th>prenom</th>
                                                        <th>produit</th>
                                                        <th>prix</th>
                                                        <th>quantity</th>
                                                        <th>montane</th>
                                                        <th>etat</th>
                                                        <th>action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php    
                                                $query = "SELECT *, m.id AS idcommande , p.id AS idpanier FROM commande as m JOIN panier as p ON m.id = p.idcommande JOIN produit as pr ON p.idproduit = pr.id JOIN client as cl ON m.idclient = cl.id WHERE  m.etat='en commander'";
                                                $result = mysqli_query($conn, $query);

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                ?>            
                                                        <tr>
                                                        <td><?php echo  $row["nom"];?></td>
                                                        <td><?php echo  $row["prenom"];?></td>
                                                        <td><?php echo  utf8_encode($row["titre"]);?></td>
                                                        <td><?php echo  $row["prix"];?></td>
                                                        <td><?php echo  $row["quantity"];?></td>
                                                        <td><?php echo  $row["montane"];?></td>

                                                        <td><?php echo  $row["etat"];?></td>
                                                        <td>
                                                        <button name="sup" id="sup" class="btn sup"  value="<?php echo  $row["idcommande"]; ?>" ><i class="feather icon-trash"></i></button>
                                                        <button name="sub" id="sub" class="btn sub"  value="<?php echo  $row["idcommande"]; ?>" style="padding: unset !important;"><i class="feather icon-check-square"></i></button>
                                                        </td> 
                                                        </tr>
                                                    <?php }?> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Column selectors with Export Options and print table -->
            </section>
            <!-- users list ends -->
                        <?php
                           
                           if (isset($_POST['sup'])){
                                    $id = $_POST['id'];
                                    $query="UPDATE `commande` SET `etat`= 'refusee' WHERE `id`=' $id'";
                                    mysqli_query($conn, $query);
                                    
                            }


                            if (isset($_POST['sub'])){
                                $id = $_POST['id'];
                                $query="UPDATE `commande` SET `etat`= 'acceptee' WHERE `id`=' $id'";
                                mysqli_query($conn, $query);   
                            }
                       ?> 
        </div>
    </div>
</div>
<!-- END: Content-->



<div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">?? Copyrights 2022 ADF Biomedical</span>
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
    <script>
    $('.sup').on('click', function(){
        var id = $(this).val();
        //  alert(id);
			$.ajax({
				url: 'les-commandes.php',
				type: 'POST',
				data: {
					sup: 1,
                    id: id,

				},
				success: function(data){
                    document.location.reload();
				}
            });	
            });

            $('.sub').on('click', function(){
        var id = $(this).val();
        //  alert(id);
			$.ajax({
				url: 'les-commandes.php',
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