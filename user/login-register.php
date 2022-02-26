<?php  
    require('../config/config.php');
    ob_start();
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
        <div class="breadcrumb-area bg-gray pt-115 ">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                        <a href="index.php">Accueil</a>
                        </li>
                        <li class="active">S'identifier - S'inscrire</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="login-register-area pt-115 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> S'identifier  </h4>
                                </a>
                                <a data-toggle="tab" href="#lg2">
                                    <h4> S'inscrire </h4>
                                </a>
                            </div>

                            <?php
                                    if (isset($_POST['Register'])){
                                        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                                        $prenom = stripslashes($_REQUEST['prenom']);
                                        $prenom = mysqli_real_escape_string($conn, $prenom); 
                                        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                                        $nom = stripslashes($_REQUEST['nom']);
                                        $nom = mysqli_real_escape_string($conn, $nom); 
                                        // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
                                        $email = stripslashes($_REQUEST['email']);
                                        $email = mysqli_real_escape_string($conn, $email);
                                        // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                                        $mot_de_passe = stripslashes($_REQUEST['mot_de_passe']);
                                        $mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);
                                        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                                        $date_de_naissance = stripslashes($_REQUEST['date_de_naissance']);
                                        $date_de_naissance = mysqli_real_escape_string($conn, $date_de_naissance); 
                                        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                                        $lieu_de_naissance = stripslashes($_REQUEST['lieu_de_naissance']);
                                        $lieu_de_naissance = mysqli_real_escape_string($conn, $lieu_de_naissance); 
                                        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                                        $addresse = stripslashes($_REQUEST['addresse']);
                                        $addresse = mysqli_real_escape_string($conn, $addresse); 

                                    
                                    $result = mysqli_query($conn,"SELECT email FROM `client` WHERE email = '$email' ");

                                    if (mysqli_num_rows($result) == 0) {
                                    
                                    $query = "INSERT into `client` (`prenom`, `nom`, `email`, `mot_de_passe`, `url-img`,`nom-img`, `date_de_naissance`, `lieu_de_naissance`, `addresse`)
                                        VALUES ('$prenom', '$nom', '$email', '".hash('sha256', $mot_de_passe)."' , 'app-assets/images/portrait/small/','avatar-s-1.jpg', '$date_de_naissance', '$lieu_de_naissance', '$addresse')";
                                        $result = mysqli_query($conn,$query);
                                        header('location: my-account.php');

                                    }else{                                    
                                        echo "<div class=\"alert alert-danger\" role=\"alert\">
                                        Le nom Email est existe deja !
                                    </div>";
                                    }
                                    
                                                            
                                    }
                                    ?>

                            <?php

                                if (isset($_POST['submit'])){
                                    $email = stripslashes($_REQUEST['email']);
                                    $email = mysqli_real_escape_string($conn, $email);
                                    $mot_de_passe = stripslashes($_REQUEST['mot_de_passe']);
                                    $mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);
                                    $query = "SELECT * FROM `client` WHERE email='$email' and mot_de_passe='".hash('sha256', $mot_de_passe)."'";
                                    $result = mysqli_query($conn,$query);
                                    if (mysqli_num_rows($result) == 1) {
                                        $user = mysqli_fetch_assoc($result);
                                        $_SESSION['id'] = $user['id'] ;
                                        $_SESSION['email'] = $user['email'] ;
                                        $_SESSION['nom'] = $user['nom'] ;
                                        $_SESSION['prenom'] = $user['prenom'] ;
                                        $_SESSION["url-img"]= $user['url-img'];
                                        $_SESSION["nom-img"]= $user['nom-img'];
                                            header('location: my-account.php');
                                       
                                    }else{                                    

                                       $message = "Le nom Email ou le mot de passe est incorrect.";
                                    }
                                }
                                ?>

                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post">
                                                <input type="text"  name="email" placeholder="email">
                                                <input type="password"  name="mot_de_passe" placeholder="Mot de passe">
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <a href="#">Mot de passe oublié ?</a>
                                                    </div>
                                                    <button type="submit" name="submit" >Connexion</button>
                                                    <!-- <input type="submit" value="Connexion " name="submit" class="box-button"> -->
                                                </div>
                                            </form>
                                        </div>
                                        <?php if (! empty($message)) { ?>
                                            <p class="errorMessage"><?php echo $message; ?></p>
                                        <?php } ?>
                                    </div>
                                </div>

                              
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form method="post">
                                                <input type="text" name="prenom" placeholder="prenom" required>
                                                <input type="text" name="nom" placeholder="nom" required>
                                                <input type="text" name="email"  placeholder="Email" type="email" required>
                                                <input type="Password" name="mot_de_passe" placeholder="mot de passe" required>
                                                <input type="date" name="date_de_naissance" placeholder="date de naissance" required>
                                                <input type="text" name="lieu_de_naissance" placeholder="lieu de naissance" required>
                                                <input type="text" name="addresse" placeholder="addresse" required>
                                                <div class="button-box">
                                                    <button type="submit" name="Register" >Register</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
<?php  include 'config/js/script.php'  ?>

</body>

</html>