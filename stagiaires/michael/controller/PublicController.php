<?php
# controller/PublicController.php

// chargement des dépendances
require_once "../model/ArticleModel.php";


// homepage

// non existance de pg
if(!isset($_GET['pg'])) {
// chargement des articles
    $articles = selectAllPlublishedArticle($db);

// chargement du template de l'accueil
    require_once "../view/homepage.html.php";
// existance de pg
}else{
    if($_GET['pg']==='about'){
        require_once "../view/about.html.php";
    }elseif($_GET['pg']==='login'){
        require_once "../view/login.html.php";
    }
}