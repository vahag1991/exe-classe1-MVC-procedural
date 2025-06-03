<?php
# controller/PublicController.php
require_once "../model/PdoModel.php";
require_once "../model/UserModel.php";
require_once "../view/homepage.html.php";

if (isset($_GET['page']) && $_GET['page'] === 'conn') {
    require_once "../view/connexion.html.php";
    if (isset($_POST['login']) && isset($_POST['pwd'])) {
        $verif = GetUser($pdo, $_POST['login'], $_POST['pwd']);
        if ($verif) {
            $_SESSION = $_POST;
            header('Location: ./');
        }
    }
}
