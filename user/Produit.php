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
<style>

#btn-add{
    display: inline-block;
    font-size: 16px;
    font-weight: 500;
    color: #fff;
    line-height: 1;
    background-color: #000000;
    padding: 15px 50px 15px;
}
#btn-add:hover {
    background-color: #ff2f2f;
    border-color: #ff2f2f;

}
</style>

        <div class="main-wrapper">


            <?php  include 'config/inc/header.php'  ?>

            <div class="breadcrumb-area bg-gray">
                <div class="container">
                    <div class="breadcrumb-content text-center">
                        <ul>
                            <li>
                            <a href="index.php">Accueil</a>
                            </li>
                            <li class="active">Produit</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="product-details-area pt-120 pb-115">
                <div class="container">

                <?php    
                if (isset($_GET['id'])){
                        $id = utf8_decode($_GET["id"]);
                        $sql = "SELECT * FROM produit WHERE `id`='$id' or `titre` LIKE '%".$id."%' LIMIT 1 ";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)) {   

                    ?> 
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="product-details-tab">
                                    <div class="product-dec-right pro-dec-big-img-slider">
                                        <div class="easyzoom-style">
                                            <div class="easyzoom easyzoom--overlay">
                                                <a href="../admin/<?php echo  $row["url-img"].$row["nom-img"]; ?>">
                                                    <img src="../admin/<?php echo  $row["url-img"].$row["nom-img"]; ?>" alt="">
                                                </a>
                                            </div>
                                            <a class="easyzoom-pop-up img-popup" href="../admin/<?php echo  $row["url-img"].$row["nom-img"]; ?>"><i class="icon-size-fullscreen"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="product-details-content pro-details-content-mt-md">
                                    <h2><?php echo  utf8_encode($row["titre"]);?></h2>
                                    <br>
                                    <p><?php echo  utf8_encode($row["contenu"]);?></p>
                                    <br>

                                    <div class="pro-details-price">
                                        <span class="new-price"><?php echo  $row["prix"];?> DA </span>
                                    </div>

                                    <div class="pro-details-quality">
                                        <span>Quantity:</span>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                        </div>
                                    </div>
                                    <div class="product-details-meta">
                                    </div>
                                    <div class="pro-details-action-wrap">
                                        <div class="pro-details-add-to-cart">
                                            <button class="sub" id="btn-add"  value="<?php echo  $row["id"]; ?>" >Ajouter au panier</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
            <div class="description-review-wrapper pb-110">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dec-review-topbar nav mb-45">
                                <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                                <a data-toggle="tab" href="#des-details2">Specification</a>
                            </div>
                            <div class="tab-content dec-review-bottom">
                                <div id="des-details1" class="tab-pane active">
                                    <div class="description-wrap">
                                        <?php if(!empty($row["Description"])): ?> 
                                            <p><?php echo  utf8_encode($row["Description"]);?></p>
                                        <?php else: ?> 
                                            <center><h2>Aucune Description Trouvée</h2></center>
                                        <?php endif ?> 
                                    </div>
                                </div>
                                <div id="des-details2" class="tab-pane">
                                    <div class="specification-wrap table-responsive">
                                        <?php if(!empty($row["Description"])): ?> 
                                            <p><?php echo  utf8_encode($row["Specification"]);?></p>
                                        <?php else: ?> 
                                            <center><h2>Aucune Specification Trouvée</h2></center>
                                        <?php endif ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?> 

                    <?php
                            if (isset($_POST['update'])){
                                $idprod = $_POST['id'];
                                $quantity = $_POST['quantity'];
                                $today = date("Y-m-d H:i:s"); 
                                $idclient =  $_SESSION['id'];

                                $produit = "SELECT prix FROM produit WHERE `id`='$idprod'";
                                $produit = mysqli_query($conn, $produit);
                                while($row = mysqli_fetch_assoc($produit)) {  

                                    $prix = $row["prix"];
                                    $prix = $prix * $quantity ;
                                

                                $sql = "INSERT INTO `commande`(`date_de_commande`, `etat`, `idclient`) 
                                VALUES ('$today','en panier','$idclient')";
                                $res = mysqli_query($conn, $sql);

                                $query = "INSERT into `panier` (`quantity`, `montane`, `idproduit`, `idcommande`, `idadmin`)                                                       
                                            VALUES ('$quantity','$prix','$idprod',LAST_INSERT_ID(),1)";



                                $result = mysqli_query($conn,$query);
                                mysqli_close($conn);

                                header('location: Boutique.php');
                                
                            } 
                        } 
                    ?>
            <div class="related-product pb-115">
                <div class="container">
                    <div class="section-title mb-45 text-center">
                        <h2>PRODUIT CONNEXE</h2>
                    </div>
                    <div class="related-product-active">
                    <?php    
                            $sql = "SELECT * FROM produit ";
                            $result = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($result)) {
                        ?> 
                        <div class="product-plr-1">
                            <div class="single-product-wrap">
                                <div class="product-img product-img-zoom mb-15">
                                    <a href="Produit.php?id=<?php echo $row["id"]; ?>">
                                        <img src="../admin/<?php echo  $row["url-img"].$row["nom-img"]; ?>" alt="">
                                    </a>

                                </div>
                                <div class="product-content-wrap-2 text-center">
                                    <div class="product-rating-wrap">

                                    </div>
                                    <h3><a href="Produit.php?id=<?php echo $row["id"]; ?>"><?php echo  utf8_encode($row["titre"]);?></a></h3>
                                    <div class="product-price-2">
                                        <span><?php echo  $row["prix"];?> DA  </span>
                                    </div>
                                </div>
                                <div class="product-content-wrap-2 product-content-position text-center">
                                    <div class="product-rating-wrap">
                                    </div>
                                    <h3><a href="Produit.php?id=<?php echo $row["id"]; ?>"><?php echo  utf8_encode($row["titre"]);?></a></h3>
                                    <div class="product-price-2">
                                        <span><?php echo  $row["prix"];?> DA  </span>
                                    </div>
                                    <div class="pro-add-to-cart">
                                        <button title="Add to Cart">Ajouter au panier</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?> 

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

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
 <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script>

    $('.sub').on('click', function(){
        var id = $(this).val();
        var quantity = $( ".cart-plus-minus-box" ).val()

			$.ajax({
				url: 'Produit.php',
				type: 'POST',
				data: {
					update: 1,
                    id: id,
                    quantity: quantity,

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