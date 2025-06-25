<?php
# controller/PublicController.php

// chargement des dépendances
require_once "../model/ArticleModel.php";
require_once "../model/UserModel.php";

// pour charger les articles en json
if(isset($_GET['json'])) {
    $articles = selectAllPlublishedArticle($db);
    echo json_encode($articles);
    exit();
}

// homepage

// non existence de pg
if (!isset($_GET['pg'])) {
// chargement des articles
    $articles = selectAllPlublishedArticle($db);



// chargement du template de l'accueil
    require_once "../view/homepage.html.php";
// existence de pg
} else {
    if ($_GET['pg'] === 'about') {
        require_once "../view/about.html.php";
    } elseif ($_GET['pg'] === 'login') {
        // création de variables pour ne pas afficher le succès
        // ou l'erreur de connexion
        $displaySucces = "d-none";
        $displayError = "d-none";
        $displayForm = "";
        // s'il existe les 2 variables post souhaitées
        // on essaye de se connecter
        if (isset($_POST['login'], $_POST['userpwd'])) {
            $connect = authentificateActivedUser($db, $_POST['login'], $_POST['userpwd']);
            if ($connect) {
                // affichage du bloc de succès
                $displaySucces = "";
                // on cache le formulaire
                $displayForm = "d-none";
                // création d'un javascript
                $jsRedirect = "<script>
    setTimeout(() => {
  window.location.href = './';
}, 3000); // Redirects after 3 seconds
</script>";
            } else {
                $displayError = "";
                /*
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
                */
            }
        }
        require_once "../view/login.html.php";
    }
}