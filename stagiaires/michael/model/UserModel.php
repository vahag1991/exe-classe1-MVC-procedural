<?php
# model/UserModel.php

/**
 * @param PDO $connect
 * @param string $user
 * @param string $pwd
 * @return bool
 */
function authentificateActivedUser(PDO $connect, string $user, string $pwd): bool
{
    // protection des mauvais copié/collé trim()
    $login = trim($user);
    $userpwd = trim($pwd);

    // requête préparée avec le login SEULEMENT si l'utilisateur est actif
    $sql = "SELECT * FROM `user` WHERE login=? AND `active`=1";
    $stmt = $connect->prepare($sql);

    try {
        $stmt->execute([$login]);
        if ($stmt->rowCount() === 0) return false;
        $utilisateur = $stmt->fetch();
        // bonne pratique
        $stmt->closeCursor();
        // vérification du mot de passe du formulaire
        // avec celui haché dans la DB
        if (password_verify($userpwd, $utilisateur['userpwd'])) {
            // création de la session active
            $_SESSION = $utilisateur;
            // suppression du mot de passe
            unset($_SESSION['userpwd']);
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }

}

/**
 * Choisir tous les users pour l'update
 * @param PDO $connection
 * @return array
 */
function selectAllUser(PDO $connection):array
{
    try{
        $select = $connection->query("SELECT `iduser`, `login` FROM `user`");
        $return = $select->fetchAll();
        $select->closeCursor();
        return $return;
    }catch(Exception $e){
        die($e->getMessage());
    }

}

// fonction pour déconnecter l'utilisateur
/**
 * @return bool
 */
function disconnectActivedUser(): bool
{
    // bonne pratique, suppression des variables de session
    // méthode tableau : $_SESSION = [];
    session_unset();

    // Si vous voulez détruire complètement la session, effacez également
    // le cookie de session.
    if (ini_get("session.use_cookies")) { // existence cookie
        $params = session_get_cookie_params(); // si oui, on récupère ses paramètres
        setcookie(session_name(), '', time() - 42000, // on recrée un cookie qui porte le même non (PHPSESSID par défaut), on le met loin dans le passé (+-11h)
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"] // on garde les mêmes propriétés
        );
    }

    // Finalement, on détruit le fichier texte de la session côté serveur.
    session_destroy();

    // envoi du booléen
    return true;
}