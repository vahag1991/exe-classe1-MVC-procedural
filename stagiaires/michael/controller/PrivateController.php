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
    // on a cliqué sur admin
    }elseif ($_GET['pg'] === "admin"){
        // chargement des tous les articles
        $articles = selectAllArticle($db);

        // chargement du template de l'accueil de l'administration
        require_once "../view/admin.homepage.html.php";
    // suppression d'un article (ctype_digit vérifie qu'un string ne contient que
        // du numérique [0-9]
    }elseif ($_GET['pg'] === "delete" && isset($_GET['idarticle']) && ctype_digit($_GET['idarticle'])){
        $idarticle = (int) $_GET['idarticle'];
        // suppresion de l'article dont l'id vaut $idarticle
        if(deleteArticle($db,$idarticle)){
            header("Location: ./?pg=admin");
            exit();
        }

    // on veut modifier l'article
    }elseif ($_GET['pg'] === "update" && isset($_GET['idarticle']) && ctype_digit($_GET['idarticle'])){
        echo $idarticle = (int) $_GET['idarticle'];
        // A FAIRE

    // on veut créer un nouvel article
    }elseif ($_GET['pg'] === "new"){

        // si on a envoyé le formulaire pour insérer un article
        if(isset($_POST['title'],$_POST['articletext'])){
            // id de l'utilisateur connexté
            $myId = $_SESSION['iduser'];
            $insert = insertArticle($db,$_POST);

        }

        require_once "../view/admin.insert.html.php";

    }
}
