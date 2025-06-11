<?php
# exemple5MVC/public/index.php

/*
 * Contrôleur frontal
 */

session_start();

// configuration de la connexion à la base de données
require_once "../model/PdoModel.php";


// Chargement du routeur
if(isset($_SESSION['login'])){
    require_once "../controller/PrivateController.php";
}else{
    require_once "../controller/PublicController.php";
}

// Débogage
// echo '<hr><h3>Barre de débogage</h3><hr>';
// echo '<h4>session_id() ou SID</h4>';
// var_dump(session_id());
// echo '<h4>$_GET</h4>';
// var_dump($_GET);
// echo '<h4>$_SESSION</h4>';
// var_dump($_SESSION);
// echo '<h3>$_POST</h3>';
// var_dump($_POST);
// echo '</div></div>';



// bonne pratique
$db = null;
