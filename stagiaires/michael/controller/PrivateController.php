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
    if ($_GET['pg'] === 'about') {
        require_once "../view/about.html.php";
    }
}
