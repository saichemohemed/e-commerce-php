<?php
    require('../config/config.php');
    session_start();

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
<title>adf biomedical</title>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
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
                        <li class="active">Contact </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="contact-area pt-115 pb-120">
            <div class="container">
                <div class="contact-info-wrap-3 pb-85">
                    <h3>contact info</h3>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="single-contact-info-3 text-center mb-30">
                                <i class="icon-location-pin "></i>
                                <h4>Notre adresse</h4>
                                <p>Cite 18/318 Logts L01, N302, Sidi Moussa 16034 </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-contact-info-3 extra-contact-info text-center mb-30">
                                <ul>
                                    <li><i class="icon-screen-smartphone"></i> (+213) 0552 09-53-48 </li>
                                    <li><i class="icon-envelope "></i> <a href="#">Adf.biomedical@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="single-contact-info-3 text-center mb-30">
                                <i class="icon-clock "></i>
                                <h4>Heure d'ouverture</h4>
                                <p>du samedi au jeudi. 9h00 - 17h00 </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                                    if (isset($_POST['submit'])){
                                        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                                        $name = stripslashes($_REQUEST['name']);
                                        $name = mysqli_real_escape_string($conn, $name); 
                                        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                                        $subject = stripslashes($_REQUEST['subject']);
                                        $subject = mysqli_real_escape_string($conn, $subject); 
                                        // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
                                        $email = stripslashes($_REQUEST['email']);
                                        $email = mysqli_real_escape_string($conn, $email);
                                        // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                                        $message = stripslashes($_REQUEST['message']);
                                        $message = mysqli_real_escape_string($conn, $message);
    
                                    $query = "INSERT into `contact` (`nom`, `message`, `email`, `Sujet`,`idadmin`)
                                        VALUES ('$name', '$subject', '$email','$message','1')";
                                        $result = mysqli_query($conn,$query);
                                        echo "<div class=\"alert alert-success\" role=\"alert\">
                                        <center>votre message est bien envoyé</center>
                                            </div>";
                                        // header('location: my-contact.php');

                                                            
                                    }
                                    ?>
                <div class="get-in-touch-wrap">
                    <h3>Entrer en contact</h3>
                    <div class="contact-from contact-shadow">
                        <form  method="post">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <input name="name" type="text" placeholder="Nom">
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <input name="email" type="email" placeholder="Email">
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <input name="subject" type="text" placeholder="Sujet">
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <textarea name="message" placeholder="Votre message"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <button class="submit" name="submit" type="submit">Envoyer le message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="contact-map pt-120">
                    <div id="map"></div>
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
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap"
      async
    ></script> 
    <script>


            function initMap() {
                var marker;

                const myLatLng = { lat: 36.59949230255911, lng: 3.086991177633942 };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 16,
                    center: myLatLng,
                });

                new google.maps.Marker({
                    position: myLatLng,
                    map,
                    title: "ADF BIOMEDICAL",
                    Label:{ color: 'black', fontWeight: 'bold', fontSize: '18px', text: 'ADF BIOMEDICAL',  lat: 100.97,lng: 77.59,  },

                  
                    
                });
                console.log(marker);

                // marker.setMap(map);

                }




    </script>
</body>

</html>