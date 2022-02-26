<?php
    require('../config/config.php');
    session_start();

?>
    <!doctype html>
    <html class="no-js" lang="en">

    <head>
        <title>adf biomedical</title>

        <?php  include 'config/css/style.php'  ?>


    </head>

    <body>

        <div class="main-wrapper">


            <?php  include 'config/inc/header.php'  ?>

            <div class="breadcrumb-area bg-gray">
                <div class="container">
                    <div class="breadcrumb-content text-center">
                        <ul>
                            <li>
                            <a href="index.php">Accueil</a>
                            </li>
                            <li class="active">Panier</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cart-main-area pt-115 pb-120">
                <div class="container">
                    <h3 class="cart-page-title">Your cart items</h3>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <form action="#">
                                <div class="table-content table-responsive cart-table-content">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>date commande</th>
                                                <th>Nom du produit</th>
                                                <th>Prix ​​unitaire</th>
                                                <th>quantity</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php    

                                            $idclient =  !empty($_SESSION['id']) ? $_SESSION['id'] : 0;
                                            if ($idclient <> 0):
                                                $query = "SELECT *, m.id AS idcommande , p.id AS idpanier FROM commande as m JOIN panier as p ON m.id = p.idcommande JOIN produit as pr ON p.idproduit = pr.id WHERE `idclient`='$idclient' and m.etat='en panier'";
                                                $result = mysqli_query($conn, $query);
                                                $row_cnt = mysqli_num_rows($result);
                                            if ($row_cnt <> 0):

                                                while($row = mysqli_fetch_assoc($result)) {  
                                                   $quantity = $row["quantity"]; 
                                        ?> 
                                                    <tr>
                                                        <td class="product-thumbnail">
                                                            <a href="#"><img src="../admin/<?php echo  $row["url-img"].$row["nom-img"]; ?>" style="width: 60% !important;" ></a>
                                                        </td>
                                                        <td class="product-subtotal"><?php echo  $row["date_de_commande"]; ?></td>
                                                        <td class="product-name"><a href="javascript:void(0)"><?php echo  utf8_encode($row["titre"]); ?></a></td>
                                                        <td class="product-price-cart" id="<?php echo  $row["prix"]; ?>"><span class="amount"><?php echo  $row["prix"]; ?></span></td>
                                                        <td class="product-quantity pro-details-quality">
                                                            <div class="cart-plus-minus sup" id="<?php echo  $row["idpanier"]; ?>">
                                                                <input class="cart-plus-minus-box" type="text"   value="<?php echo $row["quantity"] ?>">
                                                            </div>
                                                        </td>
                                                        <td class="product-remove">
                                                            <a href="javascript:void(0)" class="sub" id="<?php echo  $row["idcommande"]; ?>" ><i class="icon_close"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php } else:?> 
                                                    <tr>
                                                        <td class="product-price-cart" colspan="6"><span class="amount">aucun résultat trouvé </span></td>
                                                    </tr>
                                            <?php  endif ?> 

                                            <?php else:?> 
                                            <tr>
                                                <td class="product-price-cart" colspan="6"><span class="amount">Connectez-vous d'abord</span></td>
                                            </tr>

                                        <?php endif ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cart-shiping-update-wrapper">
                                            <div class="cart-shiping-update">
                                            </div>
                                            <?php if ($idclient <> 0 && $row_cnt <> 0): ?>
                                                <div class="cart-clear">
                                                    <button ><a href="verifier.php">conforme la commende</a></button> 

                                                </div>
                                            <?php endif ?>

                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
                           
                           if (isset($_POST['delate'])){
                               $id = $_POST['id'];
                               $sql="DELETE FROM `commande` WHERE `id`='$id'";
                               mysqli_query($conn, $sql);

                           }                           
                           if (isset($_POST['update'])){
                            $id = $_POST['id'];
                            $quantity = $_POST['quantity'];
                            $prix = $_POST['prix'];
                            $montane = $quantity * $prix;
                            $query="UPDATE `panier` SET `quantity`= $quantity ,`montane`= $montane WHERE `id`='$id'";
                            mysqli_query($conn, $query);

                        }
                       ?> 



                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="subscribe-area  pt-15 pb-15">

            </div>
            <?php  include 'config/inc/footer.php'  ?>

        </div>

        <!-- All JS is here
============================================ -->

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->

<script>
    $('.sub').on('click', function(){
        var id = $(this).attr("id");
         alert(id);
			$.ajax({
				url: 'Panier.php',
				type: 'POST',
				data: {
					delate: 1,
                    id: id,

				},
				success: function(data){
                    document.location.reload();
				}
            });	
            });

            $('.sup').on('click', function(){
                var id = $(this).attr("id");
                // alert(id);
                var quantity = $(this).find(".cart-plus-minus-box").val();
                // alert(quantity);                
                var prix = $(".product-price-cart").attr("id");
                alert(prix);
                
			$.ajax({
				url: 'Panier.php',
				type: 'POST',
				data: {
					update: 1,
                    id: id,
                    quantity: quantity,
                    prix: prix,

				},
				success: function(data){
                    // document.location.reload();
				}
            });	
            });
</script>
        <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
        <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
        <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
        <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
        <script src="assets/js/plugins/slick.js"></script>
        <script src="assets/js/plugins/jquery.syotimer.min.js"></script>
        <script src="assets/js/plugins/jquery.instagramfeed.min.js"></script>
        <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
        <script src="assets/js/plugins/wow.js"></script>
        <script src="assets/js/plugins/jquery-ui-touch-punch.js"></script>
        <script src="assets/js/plugins/jquery-ui.js"></script>
        <script src="assets/js/plugins/magnific-popup.js"></script>
        <script src="assets/js/plugins/sticky-sidebar.js"></script>
        <script src="assets/js/plugins/easyzoom.js"></script>
        <script src="assets/js/plugins/scrollup.js"></script>
        <script src="assets/js/plugins/ajax-mail.js"></script>

        <!-- Use the minified version files listed below for better performance and remove the files listed above  
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>  -->
        <!-- Main JS -->
        <script src="assets/js/main.js"></script>

    </body>

    </html>