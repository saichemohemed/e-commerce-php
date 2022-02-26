<?php
    require('../config/config.php');
    session_start();
    ob_start();

    if(!isset($_SESSION["email"])){
        header("Location: login-register.php");
        exit(); 
    }

?>

<!doctype html>
<html class="no-js" lang="fr">
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
                        <li class="active">my account </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- my account wrapper start -->
        <div class="my-account-wrapper pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                        Tableau de bord</a>
                                        <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> commande en attente</a>
                                        <a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i>commande acceptée</a>
                                        <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> adresse de facturation</a>
                                        <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Détails du compte</a>
                                        <a href="#edit-info" data-toggle="tab"><i class="fa fa-user"></i> modifier le compte</a>
                                        <a href="#Détails-info" data-toggle="tab"><i class="fa fa-user"></i> changer le mot de passe</a>
                                        <a href="logout.php"><i class="fa fa-sign-out"></i> Se déconnecter</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->
                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                    <p>Bonjour, <strong><?php echo $_SESSION['nom'].' '. $_SESSION['prenom']; ?></strong></p>
                                                </div>

                                                <p class="mb-0">Depuis le tableau de bord de votre compte. vous pouvez facilement vérifier et afficher vos commandes récentes, gérer vos adresses de livraison et de facturation et modifier votre mot de passe et les détails de votre compte.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>commande en attente</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>produit</th>
                                                                <th>Date</th>
                                                                <th>prix</th>
                                                                <th>quantity</th>
                                                                <th>montane</th>
                                                                <th>etat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php  
                                                            $idclient =  !empty($_SESSION['id']) ? $_SESSION['id'] : 0;  
                                                            $query = "SELECT *, m.id AS idcommande , p.id AS idpanier FROM commande as m JOIN panier as p ON m.id = p.idcommande JOIN produit as pr ON p.idproduit = pr.id JOIN client as cl ON m.idclient = cl.id WHERE `idclient`='$idclient' and m.etat='en commander'";
                                                            $result = mysqli_query($conn, $query);
                                                            $row_cnt = mysqli_num_rows($result);
                                                            if ($row_cnt <> 0):
                                                                while($row = mysqli_fetch_assoc($result)) {
                                                        ?>            
                                                            <tr>
                                                                <td><?php echo  utf8_encode($row["titre"]);?></td>
                                                                <td><?php echo  $row["date_de_commande"];?></td>
                                                                <td><?php echo  $row["prix"];?></td>
                                                                <td><?php echo  $row["quantity"];?></td>
                                                                <td><?php echo  $row["montane"];?></td>
                                                                <td><?php echo  $row["etat"];?></td>
                                                            </tr>
                                                        <?php } else:?> 
                                                            <tr>
                                                                <td  colspan="6">aucun résultat trouvé </td>
                                                            </tr>
                                                        <?php  endif ?> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="download" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>commande acceptée</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>produit</th>
                                                                <th>Date</th>
                                                                <th>prix</th>
                                                                <th>quantity</th>
                                                                <th>montane</th>
                                                                <th>etat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            $idclient =  !empty($_SESSION['id']) ? $_SESSION['id'] : 0;   
                                                            $query = "SELECT *, m.id AS idcommande , p.id AS idpanier FROM commande as m JOIN panier as p ON m.id = p.idcommande JOIN produit as pr ON p.idproduit = pr.id JOIN client as cl ON m.idclient = cl.id WHERE `idclient`='$idclient' and m.etat='acceptee'";
                                                            $result = mysqli_query($conn, $query);
                                                            $row_cnt = mysqli_num_rows($result);
                                                            if ($row_cnt <> 0):
                                                                while($row = mysqli_fetch_assoc($result)) {
                                                        ?>            
                                                            <tr>
                                                                <td><?php echo  utf8_encode($row["titre"]);?></td>
                                                                <td><?php echo  $row["date_de_commande"];?></td>
                                                                <td><?php echo  $row["prix"];?></td>
                                                                <td><?php echo  $row["quantity"];?></td>
                                                                <td><?php echo  $row["montane"];?></td>
                                                                <td><?php echo  $row["etat"];?></td>
                                                            </tr>
                                                        <?php } else:?> 
                                                            <tr>
                                                                <td  colspan="6">aucun résultat trouvé </td>
                                                            </tr>
                                                        <?php  endif ?> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <?php    
                                            $id =  $_SESSION['id'];
                                            $sql = "SELECT * FROM client WHERE `id`='$id' ";
                                            $result = mysqli_query($conn, $sql);

                                            while($row = mysqli_fetch_assoc($result)) {
                                        ?>  
                                            <div class="myaccount-content">
                                                <h3>adresse de facturation</h3>
                                                <address>
                                                    <p><strong><?php echo  $row["nom"] . ' ' . $row["prenom"]; ?> </strong></p>
                                                    <p><?php echo  $row["email"];?></p>
                                                    <p><?php echo  $row["adresse-de-facturation"];?></p>
                                                    <p><?php echo  $row["telephone"];?></p>
                                                </address>
                                            </div>
                                        <?php }?> 
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Détails du compte</h3>
                                                <div class="account-details-form">
                                                <?php    
                                                    $id =  $_SESSION['id'];
                                                    $sql = "SELECT * FROM client WHERE `id`='$id' ";
                                                    $result = mysqli_query($conn, $sql);

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                ?> 
                                                    <form action="#">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">nom</label>
                                                                    <input type="text" readonly value="<?php echo  $row["nom"];?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last-name" class="required">prenom</label>
                                                                    <input type="text" readonly value="<?php echo  $row["prenom"];?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="display-name" class="required">email</label>
                                                            <input type="text" readonly value="<?php echo  $row["email"];?>">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">addresse</label>
                                                            <input type="text" readonly value="<?php echo  $row["addresse"];?>">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">date de naissance</label>
                                                            <input type="text" readonly value="<?php echo  $row["date_de_naissance"];?>">
                                                        </div>                                                        
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">lieu de naissance</label>
                                                            <input type="text" readonly value="<?php echo  $row["lieu_de_naissance"];?>">
                                                        </div>                                                        
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">telephone</label>
                                                            <input type="text" readonly value="<?php echo  $row["telephone"];?>">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">adresse de facturation</label>
                                                            <input type="text" readonly value="<?php echo  $row["adresse-de-facturation"];?>">
                                                        </div>
                                                    </form>
                                                    <?php }?> 
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                        <div class="tab-pane fade" id="edit-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3> modifier le compte</h3>
                                                <div class="account-details-form">
                                                <?php    
                                                    $id =  $_SESSION['id'];
                                                    $sql = "SELECT * FROM client WHERE `id`='$id' ";
                                                    $result = mysqli_query($conn, $sql);

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                ?> 
                                                <?php

                                                    if (isset($_POST['sub'])) {
                                                        // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                                                        $nom = stripslashes($_REQUEST['nom']);
                                                        $nom = mysqli_real_escape_string($conn, $nom);
                                                        // récupérer l'prenom et supprimer les antislashes ajoutés par le formulaire
                                                        $prenom = stripslashes($_REQUEST['prenom']);
                                                        $prenom = mysqli_real_escape_string($conn, $prenom);
                                                        // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
                                                        $email = stripslashes($_REQUEST['email']);
                                                        $email = mysqli_real_escape_string($conn, $email);
                                                        // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
                                                        $date = stripslashes($_REQUEST['date']);
                                                        $date = mysqli_real_escape_string($conn, $date);
                                                        // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                                                        $lieu = stripslashes($_REQUEST['lieu']);
                                                        $lieu = mysqli_real_escape_string($conn, $lieu);                               
                                                        // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                                                        $tlf = stripslashes($_REQUEST['tlf']);
                                                        $tlf = mysqli_real_escape_string($conn, $tlf);
                                                        // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                                                        $fact = stripslashes($_REQUEST['fact']);
                                                        $fact = mysqli_real_escape_string($conn, $fact);
                                                        // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                                                        $addresse = stripslashes($_REQUEST['addresse']);
                                                        $addresse = mysqli_real_escape_string($conn, $addresse);                                
                                                        // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                                                            $query = "UPDATE `client` SET`email`='$email', `prenom`='$prenom',`nom`='$nom', `date_de_naissance`='$date', `lieu_de_naissance`='$lieu', `addresse`='$addresse' ,`telephone`='$tlf',`adresse-de-facturation`='$fact' where id ='$id' ";
                                                            mysqli_query($conn, $query);
                                                            $_SESSION['nom'] =  !empty($nom) ? $nom :  $_SESSION['nom'];
                                                            $_SESSION['prenom']=  !empty($prenom) ? $prenom :  $_SESSION['prenom'];
                                                            $_SESSION['email'] =  !empty($email) ? $email :  $_SESSION['email'];
                                                            header('location: my-account.php');
                                                        

                                                    }
                                                    ?>
                                                    <form method="POST">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">nom</label>
                                                                    <input type="text" name='nom' required value="<?php echo  $row["nom"];?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last-name" class="required">prenom</label>
                                                                    <input type="text" name='prenom' required value="<?php echo  $row["prenom"];?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="display-name" class="required">email</label>
                                                            <input type="text" name='email' required value="<?php echo  $row["email"];?>">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">addresse</label>
                                                            <input type="text" name='addresse' required value="<?php echo  $row["addresse"];?>">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">date de naissance</label>
                                                            <input type="date" name='date' required  value="<?php echo  $row["date_de_naissance"];?>">
                                                        </div>                                                        
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">lieu de naissance</label>
                                                            <input type="text" name='lieu' required  value="<?php echo  $row["lieu_de_naissance"];?>">
                                                        </div>                                                        
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">tlf</label>
                                                            <input type="text" name='tlf' required value="<?php echo  $row["telephone"];?>">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">adresse de facturation</label>
                                                            <input type="text" name='fact' required  value="<?php echo  $row["adresse-de-facturation"];?>">
                                                        </div>
                                                        <div class="single-input-item">
                                                            <button type="submit" name='sub' class="check-btn sqr-btn ">Sauvegarder les modifications</button>
                                                        </div>
                                                    </form>
                                                    <?php }?> 
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                        <div class="tab-pane fade" id="Détails-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>changer le mot de passe</h3>
                                                <div class="account-details-form">
                                                <?php

                                                    if (isset($_POST['sup'])) {
                                                        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
                                                        $pass = stripslashes($_REQUEST['pass']);
                                                        $pass = mysqli_real_escape_string($conn, $pass);
                                                        // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                                                        $pass1 = stripslashes($_REQUEST['pass1']);
                                                        $pass1 = mysqli_real_escape_string($conn, $pass1);
                                                        // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
                                                        $pass2 = stripslashes($_REQUEST['pass2']);
                                                        $pass2 = mysqli_real_escape_string($conn, $pass2);

                                                        if ($pass1 === $pass2) {
                                                                $id =  $_SESSION['id'];
                                                                $sql = "SELECT *  FROM client WHERE `id`='$id' ";                                  
                                                                $result = mysqli_query($conn, $sql);

                                                                while($row = mysqli_fetch_assoc($result)) {
                                                                    $pass3 = $row["mot_de_passe"];

                                                                    if (hash('sha256', $pass) === $pass3) {
                                                                        $pas=hash('sha256', $pass2);
                                                                       
                                                                            $query = "UPDATE `client` SET mot_de_passe ='$pas' WHERE `id`='$id' ";
                                                                            mysqli_query($conn, $query);
                                                                            header('location: my-account.php');
                                                                        

                                                                    }else {
                                                                        $_SESSION["msg"] ='Vérifiez que votre mot de passe doit être correct pour pouvoir le déverrouiller';
                                                                    }

                                                                }

                                                        }else {
                                                            $_SESSION["msg"] ='Ces deux mots de passe sont différents';
                                                        }
                                                        
                                                    }
                                                    ?>

                                                    <form method="post">
                                                        <fieldset>
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Mot de passe actuel</label>
                                                                <input type="password" name="pass" id="current-pwd" required />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">nouveau mot de passe</label>
                                                                        <input type="password"  name="pass1" id="new-pwd" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Confirmez le mot de passe</label>
                                                                        <input type="password" name="pass2" id="confirm-pwd" required />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item">
                                                            <button type="submit" name='sup' class="check-btn sqr-btn ">Sauvegarder les modifications</button>
                                                        </div>
                                                    </form>
                                                    <p class="errorMessage" style="color: red;"><?php echo !empty($_SESSION["msg"]) ; ?></p>

                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                        
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->

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