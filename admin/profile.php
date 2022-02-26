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

<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <?php  

                            $sql = "SELECT *  FROM admin";
 
                            $result = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($result)) {
                        ?>    
                        <!-- right content section -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                            <form method="POST" enctype="multipart/form-data">
                                                 <div class="media">
                                                    <a href="javascript: void(0);">
                                                        <img src="<?php echo  $row["url-img"].$row["nom-img"];?>" class="rounded mr-75" alt="profile image" height="64" width="64">
                                                    </a>
                                                    <div class="media-body mt-75">
                                                        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                            <input type="file" id="account-upload" hidden name="image">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-username">Nom d utilisateur</label>
                                                                    <input type="text" name='username' class="form-control" id="account-username" placeholder="Username" value="<?php echo  $row["nom"];?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">E-mail</label>
                                                                    <input type="email" name='email' class="form-control" id="account-e-mail" placeholder="Email" value="<?php echo  $row["email"];?>"readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">Nom</label>
                                                                    <input type="text" name='nom' class="form-control" id="account-name" placeholder="Name" value="<?php echo  $row["nom"];?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="account-company">prenom</label>
                                                                <input type="text" name='prenom' class="form-control" id="account-company" placeholder="Email" value="<?php echo  $row["prenom"];?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="account-company">addresse</label>
                                                                <input type="text" name='addresse' class="form-control" id="account-company" placeholder="Email" value="<?php echo  $row["addresse"];?>" readonly>
                                                            </div>
                                                        </div>                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">date de naissance</label>
                                                                    <input type="text" name='date' class="form-control" id="account-name" placeholder="Name" value="<?php echo  $row["date_de_naissance"];?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
 

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php }?> 

                    </div>
                </section>
                <!-- account setting page end -->

            </div>
        </div>
    </div>
    <?php
    require('footer.php');
    ?>