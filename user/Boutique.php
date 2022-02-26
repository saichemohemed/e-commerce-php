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
                            <li class="active">Boutique</li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php  
                                        
                                        if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                                            $page_no = $_GET['page_no'];
                                            } else {
                                                $page_no = 1;
                                                }
                                                $total_records_per_page = 12;
                                                $offset = ($page_no-1) * $total_records_per_page;
                                                $previous_page = $page_no - 1;
                                                $next_page = $page_no + 1;
                                                $adjacents = "2";
                                                $result_count = mysqli_query(
                                                    $conn,
                                                    "SELECT COUNT(*) As total_records FROM `produit`"
                                                    );
                                                    $total_records = mysqli_fetch_array($result_count);
                                                    $total_records = $total_records['total_records'];
                                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                                    $second_last = $total_no_of_pages - 1; // total pages minus 1
                                                $result = mysqli_query(
                                                    $conn,
                                                    "SELECT * FROM `produit` LIMIT $offset, $total_records_per_page"
                                                    );

                                        ?> 
            <div class="shop-area pt-120 pb-120 section-padding-2">
                <div class="container">
                    <div class="row flex-row-reverse">
                        <div class="col-lg-12">
                            <div class="shop-topbar-wrapper">
                                <div class="shop-topbar-left">
                                    <div class="view-mode nav">
                                        <a class="active" href="#shop-1" data-toggle="tab"><i class="icon-grid"></i></a>
                                    </div>
                                    <p>Montrant <?php echo $page_no." de ".$total_no_of_pages; ?> résultats</p>
                                </div>
                                <div class="product-sorting-wrapper">
                                    <div class="product-shorting shorting-style">
                                        <label>Voir :</label>
                                        <select>
                                        <option value=""> 20</option>
                                    </select>
                                    </div>
                                    <div class="product-show shorting-style">
                                        <label>Trier par :</label>
                                        <select>
                                        <option value=""> Nom</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-bottom-area">
                                <div class="tab-content jump">
                                    <div id="shop-1" class="tab-pane active">
                                        <div class="row">
                                       
                                       <?php 
                                             while($row = mysqli_fetch_assoc($result)) {

                                        ?>

                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                                <div class="single-product-wrap mb-35">
                                                    <div class="product-img product-img-zoom mb-15">
                                                        <a href="Produit.php?id=<?php echo $row["id"]; ?>">
                                                            <img src="../admin/<?php echo  $row["url-img"].$row["nom-img"]; ?>" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-content-wrap-2 text-center">

                                                        <h3><a href="Produit.php?id=<?php echo $row["id"]; ?>"><?php echo  utf8_encode($row["titre"]);?></a></h3>
                                                        <div class="product-price-2">
                                                            <span><?php echo  $row["prix"];?> DA  </span>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap-2 product-content-position text-center">
                                                        <h3><a href="Produit.php?id=<?php echo $row["id"]; ?>"><?php echo  utf8_encode($row["titre"]);?></a></h3>
                                                        <div class="product-price-2">
                                                            <span><?php echo  $row["prix"];?> DA  </span>
                                                        </div>
                                                        <div class="pro-add-to-cart">
                                                        <button class="sub" id="btn-add"  value="<?php echo  $row["id"]; ?>" >Ajouter au panier</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?> 

                                        </div>

                                    </div>
                                </div>
                                <div class="pro-pagination-style text-center mt-10">
                                    <ul>
                                        <?php if($page_no > 1){
                                            echo "<li><a href='?page_no=1'> << </i></a></li>";
                                            } ?>
                                                
                                            <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                                            <a class="prev" <?php if($page_no > 1){
                                            echo "href='?page_no=$previous_page'";
                                            } ?>><i class="icon-arrow-left"></i></a>
                                            </li>
                                            <?php 
                                                if ($total_no_of_pages <= 10){  	 
                                                    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                                                    if ($counter == $page_no) {
                                                    echo "<li><a class='active'>$counter</a></li>";	
                                                            }else{
                                                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                                }
                                                        }
                                                }
                                            ?>
                                            <li <?php if($page_no >= $total_no_of_pages){
                                            echo "class='disabled'";
                                            } ?>>
                                            <a class="next" <?php if($page_no < $total_no_of_pages) {
                                            echo "href='?page_no=$next_page'";
                                            } ?>><i class="icon-arrow-right"></i></a>
                                            </li>

                                            <?php if($page_no < $total_no_of_pages){
                                            echo "<li><a href='?page_no=$total_no_of_pages'> >> </a></li>";
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
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
				url: 'Boutique.php',
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