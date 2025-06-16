<?php
# model/UserModel.php

function authentificateActivedUser(PDO $connect, string $user, string $pwd):bool
{
    // protection des mauvais copié/collé trim()
    $login = trim($user);
    $userpwd = trim($pwd);

    // requête préparée avec le login SEULEMENT si l'utilisateur est actif
    $sql = "SELECT * FROM `user` WHERE login=:username AND `active`=1";
    $stmt = $connect->prepare($sql);

    try{
        $stmt->execute(['username'=>$login]);
        if($stmt->rowCount()===0) return false;
        $utilisateur = $stmt->fetch();
        // bonne pratique
        $stmt->closeCursor();
        // vérification du mot de passe du formulaire
        // avec celui haché dans la DB
        if(password_verify($userpwd,$utilisateur['userpwd'])){
            // création de la session active
            $_SESSION = $utilisateur;
            // suppression du mot de passe
            unset($_SESSION['userpwd']);
            return true;
        }else{
            return false;
        }
    }catch(Exception $e){
        die($e->getMessage());
    }

}

// fonction pour déconnecter l'utilisateur
function disconnectActivedUser():void
{
    // bonne pratique, suppression des variables de session
    // méthode tableau : $_SESSION = [];
    session_unset();

    // Si vous voulez détruire complètement la session, effacez également
    // le cookie de session.
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalement, on détruit la session côté serveur.
    session_destroy();
}