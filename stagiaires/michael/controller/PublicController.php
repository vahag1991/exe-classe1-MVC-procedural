<?php
# controller/PublicController.php

// chargement des dépendances
require_once "../model/ArticleModel.php";
require_once "../model/UserModel.php";


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
        // s'il existe les 2 variables post souhaitées
        // on essaye de se connecter
        if(isset($_POST['login'],$_POST['userpwd'])){
            $connect = authentificateActivedUser($db,$_POST['login'],$_POST['userpwd']);
            if($connect){
                echo "ok";
            }else{
                echo "ko";
                // on compte le nombre de tentatives de connexion
                // ICI options
                if(isset($_SESSION['compte'])){
                    $_SESSION['compte']++;
                    if($_SESSION['compte']>3){
                        $_SESSION['adresseip'] = $_SERVER['REMOTE_ADDR'];
                        header("Location: http://www.google.be");
                    }
                }else{
                    $_SESSION['compte']=1;
                }
            }
        }
        require_once "../view/login.html.php";
    }
}