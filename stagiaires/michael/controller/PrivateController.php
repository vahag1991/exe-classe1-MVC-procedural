<?php
# controller/PrivateController.php
// chargement des dépendances
require_once "../model/ArticleModel.php";
require_once "../model/UserModel.php";


// homepage

// non existence de pg
if(!isset($_GET['pg'])) {
// chargement des articles
    $articles = selectAllPlublishedArticle($db);

// chargement du template de l'accueil
    require_once "../view/homepage.html.php";
// existence de pg
}else {
    // on a cliqué sur à propos
    if ($_GET['pg'] === 'about') {
        require_once "../view/about.html.php";
    // on a cliqué sur disconnect
    }elseif($_GET['pg'] === 'disconnect') {
        // si la déconnexion a réussi
        if(disconnectActivedUser()) {
            // redirection
            header("Location: ./");
            exit();
        }
    }
}
