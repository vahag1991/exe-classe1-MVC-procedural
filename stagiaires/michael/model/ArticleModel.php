<?php
# model/ArticleModel.php

/**
 * @param PDO $connexion
 * @return array
 * Sélection de tous articles publiés
 * classés par articledatepublished DESC
 */
function selectAllPlublishedArticle(PDO $connexion): array
{
    $sql = "
    SELECT a.`title`, a.`slug`, SUBSTR(a.`articletext`,1,250) AS articletext, a.`articledatepublished`,
           u.`login`, u.`username`
    FROM `article` a 
    JOIN `user` u 
        ON u.`iduser` = a.`user_iduser`
    WHERE a.`articlepublished` = 1
    ORDER BY a.`articledatepublished` DESC
    ;
    ";
    try {
        // requête
        $query = $connexion->query($sql);
        // récupération des résultats (tableau indexé, si 0 => [])
        $resultat = $query->fetchAll();
        // bonne pratique
        $query->closeCursor();
        // envoyer le résultat
        return $resultat;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/**
 * Sélection pour l'administration
 * @param PDO $connexion
 * @return array
 */
function selectAllArticle(PDO $connexion): array
{
    $sql = "
    SELECT a.`idarticle`, a.`title`, a.`slug`, SUBSTR(a.`articletext`,1,80) AS articletext, a.`articlepublished`, a.`articledatepublished`,
           u.`login`
    FROM `article` a 
    LEFT JOIN `user` u 
        ON u.`iduser` = a.`user_iduser`
    ORDER BY a.`articlepublished` ASC, 
             a.`articledatepublished` DESC
    ;
    ";
    try {
        // requête
        $query = $connexion->query($sql);
        // récupération des résultats (tableau indexé, si 0 => [])
        $resultat = $query->fetchAll();
        // bonne pratique
        $query->closeCursor();
        // envoyer le résultat
        return $resultat;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/**
 * On récupère l'article pour l'update (avec son user de base))
 * @param PDO $connexion
 * @param int $idarticle
 * @return array|bool
 */
function selectOneArticleById(PDO $connexion, int $idarticle): array|bool
{
    $sql = "SELECT a.`idarticle`, a.`title`, a.`slug`, a.`articletext`, a.`articlepublished`, a.`articledatepublished`,
           u.iduser, u.`login`
    FROM `article` a 
    LEFT JOIN `user` u 
        ON u.`iduser` = a.`user_iduser`
        WHERE a.`idarticle`= ?";
    $prepare = $connexion->prepare($sql);

    try{
        // on récupère 1 ou 0 article
       $prepare->execute([$idarticle]);
       if($prepare->rowCount()===0) return false;
       // on a trouvé un article
       $recup = $prepare->fetch();
       $prepare->closeCursor();
       return $recup;

    }catch(Exception $e){
        die($e->getMessage());
    }
}

function updateArticleById(PDO $connection, array $datas, int $idarticle){
    // on vérifie que la personne n'essaye pas d'accéder à un autre article
    if($datas['idarticle']!=$idarticle) die("Attaque !");
    // préparation de la requête
    $sql = "UPDATE `article` SET `title`= :title,
                       `slug`= :slug,
                       `articletext`= :text,
                       `articlepublished` = :published,
                       `articledatepublished` = :date,
                        `user_iduser` = :userid
                       WHERE `idarticle`= :id";

    // On va traiter nos variables post avant une éventuelle mise à jour


    $title = htmlspecialchars(trim(strip_tags($datas['title'])),ENT_QUOTES);

    // création du slug depuis le title
    $slug = htmlspecialchars(trim(strip_tags($datas['slug'])),ENT_QUOTES);


    if (
        empty($title) ||
        empty($slug) ||
        strlen($title) > 160 ||
        strlen($slug) > 165) return false;

    // on va encoder le text
    $text = htmlspecialchars(trim(strip_tags($datas['articletext'])), ENT_QUOTES);

    $iduser = (int) $datas['user_iduser'];

    // si vide
    if (empty($text)) return false;

    // on vérifie si publié
    if (isset($datas['articlepublished'])) {
        $isPublished = 1;
        $datePublished = $datas['articledatepublished'] === "" ? date("Y-m-d H:i:s") : $datas['articledatepublished'];
    } else {
        $isPublished = 0;
        $datePublished = null;
    }
    $prepare = $connection->prepare($sql);

    try{
        $prepare->bindValue("id",$idarticle,PDO::PARAM_INT);
        $prepare->bindValue("userid",$iduser,PDO::PARAM_INT);
        $prepare->bindValue("date",$datePublished);
        $prepare->bindValue("published",$isPublished,PDO::PARAM_INT);
        $prepare->bindValue("text",$text);
        $prepare->bindValue("slug",$slug);
        $prepare->bindValue("title",$title,);

        $prepare->execute();
        return true;

    }catch(Exception $e){
        die($e->getMessage());
    }

}

/**
 * Supprime un article
 * @param PDO $connexion
 * @param int $id
 * @return bool
 */
function deleteArticle(PDO $connexion, int $id): bool
{
    // requête préparée
    $sql = "DELETE FROM `article` WHERE `idarticle`=?";
    $prepare = $connexion->prepare($sql);
    try {
        $prepare->execute([$id]);
        $prepare->closeCursor();
        return true;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/**
 * @param PDO $con
 * @param array $datas
 * @return bool
 * @throws \Random\RandomException
 */
function insertArticle(PDO $con, array $datas): bool
{
    // id de l'utilisateur connecté
    // variable globale de type session
    $myId = $_SESSION['iduser'];

    // On va traiter nos variables post avant une éventuelle insertion
    $title = trim(strip_tags($datas['title']));

    // création du slug depuis le title
    $slug = sluggifyTitle($title);

    // on peut encoder le titre
    $title = htmlspecialchars($title, ENT_QUOTES);

    if (
        empty($title) ||
        empty($slug) ||
        strlen($title) > 160 ||
        strlen($slug) > 165) return false;

    // on va encoder le text
    $text = htmlspecialchars(trim(strip_tags($datas['articletext'])), ENT_QUOTES);

    // si vide
    if (empty($text)) return false;

    // on vérifie si publié
    if (isset($datas['articlepublished'])) {
        $isPublished = 1;
        $datePublished = $datas['articledatepublished'] === "" ? date("Y-m-d H:i:s") : $datas['articledatepublished'];
    } else {
        $isPublished = 0;
        $datePublished = null;
    }

    $sql = "INSERT INTO `article` (`title`,
                       `slug`,
                       `articletext`,
                       `articlepublished`,
                       `articledatepublished`, `user_iduser`) VALUES (?,?,?,?,?,?)";

    $prepare = $con->prepare($sql);

    try {

        $prepare->execute([
            $title, $slug, $text, $isPublished, $datePublished, $myId
        ]);
        return true;

    } catch (Exception $e) {
        die($e->getMessage());
    }


}

/**
 * Génère un slug à partir d'une chaîne de caractères en utilisant Transliterator.
 *
 * Cette fonction utilise l'extension PHP intl (Transliterator) pour une gestion
 * avancée de la translittération des caractères Unicode en équivalents ASCII,
 * rendant la "slugification" plus robuste pour diverses langues.
 *
 * @param string $text La chaîne de caractères à "slugifier".
 * @return string Le slug généré.
 * @throws RuntimeException Si l'extension intl n'est pas chargée.
 * @throws \Random\RandomException
 */
function sluggifyTitle(string $text): string
{

    // 1. Convertir la chaîne en UTF-8 pour s'assurer d'une bonne gestion par Transliterator
    //    (bien que Transliterator gère généralement les encodages, c'est une bonne pratique).
    $text = mb_convert_encoding($text, 'UTF-8', mb_detect_encoding($text) ?: 'UTF-8');

    // 2. Créer un translittérateur.
    //    ':: Any-Latin;' : Convertit n'importe quel script en son équivalent latin.
    //    ':: Latin-ASCII;' : Convertit le script latin en ASCII, gérant les accents.
    //    ':: Lower();' : Convertit en minuscules. C'est plus propre de le faire ici.
    //    ':: NFD; :: [:Nonspacing Mark:] Remove; :: NFC;' : Normalisation pour gérer certains cas complexes
    //                                                     (par ex. lettres avec accents décomposés).
    $transliterator = Transliterator::createFromRules(
        ':: Any-Latin; :: Latin-ASCII; :: Lower(); :: NFD; :: [:Nonspacing Mark:] Remove; :: NFC;'
    );

    $slug = $transliterator->transliterate($text);

    // 3. Supprimer tous les caractères qui ne sont pas des lettres, des chiffres ou des tirets/espaces.
    //    À ce stade, Transliterator a déjà fait l'essentiel du travail des accents et minuscules.
    //    On utilise `preg_replace` pour nettoyer les symboles restants et les caractères non alphanumériques.
    //    Notez que \p{L} et \p{N} fonctionnent toujours avec le flag 'u' pour l'Unicode.
    $slug = preg_replace('/[^\p{L}\p{N}\s-]/u', '', $slug);

    // 4. Remplacer les multiples espaces et/ou tirets par un seul tiret.
    $slug = preg_replace('/[\s-]+/', '-', $slug);

    // 5. Supprimer les tirets en début et fin de chaîne.
    $slug = trim($slug, '-');

    // 6. Création d'un préfix de 4 caractères pour rendre le slug unique
    //  et retour en hexadécimal * 2
    return bin2hex(random_bytes(2)) . "-" . $slug;

}

/**
 * Evite de couper un texte au milieu
 * d'un mot
 * @param string $text
 * @return string
 *
 */
function cutTheText(string $text): string
{
    // on récupère la position du dernier espace dans le texte
    $lastSpace = strripos($text, " ");
    // on coupe le texte de 0 à la position de l'espace vide
    return substr($text, 0, $lastSpace) . "...";
}