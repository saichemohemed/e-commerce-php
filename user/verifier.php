<?php
    require('../config/config.php');
    session_start();
    if(!isset($_SESSION["email"])){
        header("Location: login-register.php");
        exit(); 
    }

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
                            <li class="active">verifier</li>
                        </ul>
                </div>
            </div>
        </div>
        <div class="checkout-main-area pt-120 pb-120">
            <div class="container">
            <?php    
                $idclient =  $_SESSION['id'];
                $query = "SELECT * FROM client WHERE `id`='$idclient'";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)) {  
                   $facturation = $row["adresse-de-facturation"] 
            ?> 
                <div class="customer-zone mb-20">
                    <p class="cart-page-title">Détails de facturation complets</p>
                </div>                
                <?php if(empty($facturation )):?> 

                <div class="customer-zone mb-20">
                    <p class="cart-page-title">Vous devez d'abord renseigner le champ Adresse De Facturation </p>
                </div>
                <?php endif?> 

                <div class="checkout-wrap pt-30">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="billing-info-wrap mr-50">
                                <h3>DÉTAILS DE LA FACTURATION</h3>
                                <div class="row">

                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20">
                                            <label>nom <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" value="<?php echo $row["nom"] ?> " readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info mb-20">
                                            <label>prenom<abbr class="required" title="required">*</abbr></label>
                                            <input type="text"  value="<?php echo $row["prenom"] ?> " readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>email <abbr class="required" title="required">*</abbr></label>
                                            <input type="text "  value="<?php echo $row["email"] ?> " readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>addresse <abbr class="required" title="required">*</abbr></label>
                                            <input type="text"value="<?php echo $row["addresse"] ?> " readonly>
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>telephone <abbr class="required" title="required">*</abbr></label>
                                            <input type="text"value="<?php echo $row["telephone"] ?> " readonly>
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-12">
                                        <div class="billing-info mb-20">
                                            <label>adresse de facturation <abbr class="required" title="required">*</abbr></label>
                                            <input type="text"value="<?php echo $row["adresse-de-facturation"] ?> " readonly>
                                        </div>
                                    </div>
                                
                                    <?php }?> 
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="your-order-area">
                                <h3>VOTRE COMMANDE</h3>
                                <div class="your-order-wrap gray-bg-4">
                                    <div class="your-order-info-wrap">
                                        <div class="your-order-info">
                                            <ul>
                                                <li>Produit <span>Total</span></li>
                                            </ul>
                                        </div>
                                        <div class="your-order-middle">
                                            <ul>
                                            <?php    
                                                $idclient =  $_SESSION['id'];
                                                $query = "SELECT *, m.id AS idcommande , p.id AS idpanier  FROM commande as m JOIN panier as p ON m.id = p.idcommande JOIN produit as pr ON p.idproduit = pr.id WHERE `idclient`='$idclient' and m.etat='en panier'";
                                                $result = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_assoc($result)) {  
                                            ?> 
                                                <li><?php echo  utf8_encode($row["titre"]); ?> X <?php echo $row["quantity"] ?> <span><?php echo $row["montane"] ?> DA </span></li>

                                            <?php }?> 
                                            </ul>
                                        </div>
                                        <?php    
                                                $idclient =  $_SESSION['id'];
                                                $query = "SELECT *, SUM(montane) as mo  FROM commande as m JOIN panier as p ON m.id = p.idcommande JOIN produit as pr ON p.idproduit = pr.id WHERE `idclient`='$idclient' and m.etat='en panier'";
                                                $result = mysqli_query($conn, $query);
                                                while($row = mysqli_fetch_assoc($result)) {  
                                                    $counte = $row["mo"];
                                            ?> 
                                        <div class="your-order-info order-total">
                                            <ul>
                                                <li>Total <span><?php echo $counte; ?></span></li>
                                            </ul>
                                        </div>
                                        <?php }?> 

                                    </div>
                                </div>
                                <?php if(!empty($facturation )):?> 
                                    <div class="Place-order">
                                        <a href="#" class="sub">Passer la commande</a>
                                    </div>
                                <?php endif ?> 


                                <?php                           
                                    if (isset($_POST['update'])){
                                        $idclient =  $_SESSION['id'];
                                        $query = "SELECT *, m.id AS idcommande , p.id AS idpanier  FROM commande as m JOIN panier as p ON m.id = p.idcommande JOIN produit as pr ON p.idproduit = pr.id WHERE `idclient`='$idclient' and m.etat='en panier'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id =  $row["idcommande"];
                                            $query="UPDATE `commande` SET `etat`= 'en commander' WHERE `id`=' $id'";
                                            mysqli_query($conn, $query);
                                        }    }
                                ?> 



                            </div>
                        </div>
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
				url: 'verifier.php',
				type: 'POST',
				data: {
					update: 1,
                    id: id,

				},
				success: function(data){
                    document.location.reload();
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