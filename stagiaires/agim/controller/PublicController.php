<?php
# controller/PublicController.php
require_once "../model/UserModel.php";
require_once "../model/ArticleModel.php";


if (isset($_GET['page']) && $_GET['page'] === 'conn') {

    require_once "../view/connexion.html.php";
    require_once "../view/inscription.html.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Traitement de la connexion
        if (isset($_POST['login'], $_POST['pwd'])) {
            $login = htmlspecialchars($_POST['login']);
            $pwd = htmlspecialchars($_POST['pwd']);

            $authResult = authenticateUser($pdo, $login, $pwd);

            if ($authResult === true) {
                $_SESSION['login'] = $login;
                $_SESSION['success'] = "Connexion réussie. Bienvenue, $login !";
                header('Location: ./');
                exit();
            } else {
                $_SESSION['error'] = "Connexion échoué"; // Le message d’erreur retourné par la fonction
                header('Location: ./?page=conn');
                exit();
            }
        }

        // Traitement de l'inscription
        if (isset($_POST['login_inscription'], $_POST['pwd_inscription'])) {
            $registerLogin = htmlspecialchars($_POST['login_inscription']);
            $registerName = htmlspecialchars($_POST['full_name']);
            $registerMail = htmlspecialchars($_POST['mail_inscription']);
            $registerPwd = htmlspecialchars($_POST['pwd_inscription']);

            if (registerUser($pdo, $registerLogin, $registerName, $registerMail, $registerPwd)) {
                $_SESSION['success'] = "Inscription réussie. Vous pouvez  connecter.";
                header('Location: ./');
                exit();
            } else {
                $_SESSION['error'] = "L'inscription a échoué. Veuillez réessayer.";
                header('Location: ./?page=conn');
                exit();
            }
        }
    }
} elseif (isset($_GET['page']) && $_GET['page'] === 'about') {
    require_once "../view/aboutPage.html.php";
} else {

    $articlesOrderByPublishedDesc = getArticleOrderByPublishedDesc($pdo);
    require_once "../view/homepage.html.php";

}
