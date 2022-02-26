<style>
#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:100%;position: absolute;z-index: 2;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
</style>
<header class="header-area ">
            <div class="header-large-device">
                <div class="header-top header-top-ptb-1 border-bottom-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-7">
                                <div class="social-offer-wrap">
                                    <div class="social-style-1">
                                        <a href="#"><i class="icon-social-twitter"></i></a>
                                        <a href="https://www.facebook.com/ADF-Biomedical-142676946487860/"><i class="icon-social-facebook"></i></a>
                                        <a href="https://www.instagram.com/adfbiomedical/?utm_medium=copy_link"><i class="icon-social-instagram"></i></a>
                                        <a href="#"><i class="icon-social-youtube"></i></a>
                                        <a href="#"><i class="icon-social-pinterest"></i></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-5">
                                <div class="header-top-right">
                                <div class="header-offer-wrap-2">
                                        <p><span>LIVRAISON GRATUITE</span> dans le Wilaya d'Alger pour toutes les commandes de plus de 5000 DA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-middle header-middle-padding-2">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/images/logo/logo.png" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7">
                                <div class="categori-search-wrap categori-search-wrap-modify-3">
                                    <div class="categori-style-1">
                                        <select class="nice-select nice-select-style-1">
                                            <option>Toutes catégories</option>
                                            <option>Materiel Pharmacie </option>
                                        </select>
                                    </div>
                                    <div class="search-wrap-3">
                                        <form action="Produit.php">
                                            <input class="typeahead" name="id"  id="search-box" placeholder="Recherche de produits..." type="text">
                                            <button class="blue"  onClick="return empty()" ><i class="lnr lnr-magnifier"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-xl-offset-2 col-xl-12 col-lg-12" id="suggesstion-box" style="padding-left: 0 !important;"></div>
                            </div>
                            <div class="col-xl-3 col-lg-3">
                                <div class="hotline-2-wrap">
                                    <div class="hotline-2-icon">
                                        <i class="blue icon-call-end"></i>
                                    </div>
                                    <div class="hotline-2-content">
                                        <span> Hotline 24/7</span>
                                        <h5>(+213) 0552 09-53-48 </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom bg-blue">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-3">
                                <div class="main-categori-wrap main-categori-wrap-modify-2">
                                    <a class="categori-show categori-blue" href="#">Tout le département <i class="icon-arrow-down icon-right"></i></a>
                                    <div class="category-menu-2 category-menu-2-blue categori-hide categori-not-visible-2">
                                        <nav>
                                            <ul>
                                                <li><a href="Boutique.php"><i class="icon-energy"></i>Materiel Pharmacie</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="main-menu main-menu-white main-menu-padding-1 main-menu-font-size-14 main-menu-lh-5">
                                    <nav>
                                        <ul>
                                            <li><a href="Boutique.php">BOUTIQUE</a></li>
                                            <li><a href="qui-sommes-nous.php">QUI SOMMES-NOUS ? </a></li>
                                            <li><a href="contact.php">CONTACT </a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                              <?php    
                                    $idclient =  !empty($_SESSION['id']) ? $_SESSION['id'] : 0;
                                    $query = "SELECT *, SUM(montane) as mo , count(montane) as co FROM commande as m JOIN panier as p ON m.id = p.idcommande JOIN produit as pr ON p.idproduit = pr.id WHERE `idclient`='$idclient' and m.etat='en panier'";
                                    $result = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_assoc($result)) {  
                                        $SUM = $row["mo"];
                                        $counte = $row["co"];
                                }?> 

                            <div class="col-lg-3">
                                <div class="header-action header-action-flex pr-20">
                                    <div class="same-style-2 same-style-2-white same-style-2-font-dec">
                                    <?php  if(!empty($_SESSION["email"])):  ?> 
                                        <a href="my-account.php"><i class="icon-user"></i></a>   
                                    <?php  else: ?> 
                                        <a href="login-register.php"><i class="icon-user"></i></a>   
                                    <?php endif ?>                                  
                                    </div>
                                    <div class="same-style-2 same-style-2-white same-style-2-font-dec header-cart">
                                        <a  href="Panier.php">
                                            <i class="icon-basket-loaded"></i>
                                            <?php  if(!empty($_SESSION["email"])):  ?> 
                                                <span class="pro-count red"><?php echo $counte ; ?></span>
                                                <span class="cart-amount white"><?php echo $SUM ; ?> DA</span>
                                            <?php  else: ?> 
                                                <span class="pro-count red">0</span>
                                                <span class="cart-amount white">0 DA</span>
                                            <?php endif ?>                                  

                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-small-device small-device-ptb-1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <div class="mobile-logo">
                                <a href="index.html">
                                    <img alt="" src="assets/images/logo/logo.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="header-action header-action-flex">
                                <div class="same-style-2 same-style-2-font-inc">
                                <?php  if(!isset($_SESSION["email"])){  ?> <a href="my-account.php"><i class="icon-user"></i></a>   
                                <?php  } else { ?> <a href="login-register.php"><i class="icon-user"></i></a>   <?php } ?>                                    </div>
                                <div class="same-style-2 same-style-2-font-inc">
                                    <a href="Panier.php"><i class="icon-basket-loaded"></i><span class="pro-count red">02</span></a>
                                </div>
                                <div class="same-style-2 main-menu-icon">
                                    <a class="mobile-header-button-active" href="Panier.php"><i class="icon-menu"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- mobile header start -->
        <div class="mobile-header-active mobile-header-wrapper-style">
            <div class="clickalbe-sidebar-wrap">
                <a class="sidebar-close"><i class="icon_close"></i></a>
                <div class="mobile-header-content-area">
                    <div class="header-offer-wrap-2 mrg-none mobile-header-padding-border-4">
                         <p><span>LIVRAISON GRATUITE</span> dans le Wilaya d'Alger pour toutes les commandes de plus de 5000 DA</p>
                    </div>
                    <div class="mobile-search mobile-header-padding-border-1">
                        <form class="search-form" action="Boutique.php">
                            <input type="text" placeholder="Recherche de produits...">
                            <button class="button-search"><i class="icon-magnifier"></i></button>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-padding-border-2">
                        <!-- mobile menu start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children "><a href="Boutique.php">BOUTIQUE</a></li>
                                <li class="menu-item-has-children"><a href="qui-sommes-nous">QUI SOMMES-NOUS ?</a></li>
                                <li><a href="contact.php">CONTACT</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                    <div class="main-categori-wrap mobile-menu-wrap mobile-header-padding-border-3">
                        <a class="categori-show blue" href="Boutique.php">
                            <i class="lnr lnr-menu"></i> All Department <i class="icon-arrow-down icon-right"></i>
                        </a>
                        <div class="categori-hide-2">
                            <nav>
                                <ul class="mobile-menu">
                                    <li><a href="Boutique.php"><i class="icon-energy"></i> Materiel Pharmacie </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="mobile-contact-info mobile-header-padding-border-4">
                        <ul>
                            <li><i class="icon-phone "></i>(+213) 0552 09-53-48</li>
                            <li><i class="icon-envelope-open "></i>Adf.biomedical@gmail.com</li>
                            <li><i class="icon-home"></i> Cite 18/318 Logts L01, N302, Sidi Moussa 16034</li>
                        </ul>
                    </div>
                    <div class="mobile-social-icon">
                        <a class="facebook" href="#"><i class="icon-social-facebook"></i></a>
                        <a class="twitter" href="#"><i class="icon-social-twitter"></i></a>
                        <a class="pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                        <a class="instagram" href="#"><i class="icon-social-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- mini cart start -->
        <div class="sidebar-cart-active">
            <div class="sidebar-cart-all">
                <a class="cart-close" href=""><i class="icon_close"></i></a>
                <div class="cart-content">
                    <h3>Shopping Cart</h3>

                    <div class="cart-checkout-btn">
                        <a class="btn-hover cart-btn-style" href="Panier.php">voir le panier</a>
                        <a class="no-mrg btn-hover cart-btn-style" href="verifier.php">vérifier</a>
                    </div>
                </div>
            </div>
        </div>
  <script src="config/js/jquery-3.6.0.js"></script>
  <script src="config/js/jquery-ui.js"></script>
  <script>
    $(document).ready(function(){
	$(".typeahead").keyup(function(){
		$.ajax({
		type: "POST",
		url: "search.php",
		data:'keyword='+$(this).val(),

		success: function(data){
            console.log(data);
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
		}
		});
	});
});
//To select country name
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
  </script>     
<script>
function empty() {
    var x;
    x = document.getElementById("search-box").value;
    if (x == "") {
            return false;        
            };
}
</script>