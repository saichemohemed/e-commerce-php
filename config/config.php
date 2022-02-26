<?php
// Informations d'identification
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ecommerce');
 
// Connexion  la base de donnees MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Verifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}else{
    // echo 'connection successful';
}
?>      
