<?php
# model/ArticleModel.php

/**
 * @param PDO $connexion
 * @return array
 * Sélection de tous articles publiés
 * classés par articledatepublished DESC
 */
function selectAllPlublishedArticle(PDO $connexion):array
{
    $sql="
    SELECT a.`title`, a.`slug`, SUBSTR(a.`articletext`,1,250) AS articletext, a.`articledatepublished`,
           u.`login`, u.`username`
    FROM `article` a 
    JOIN `user` u 
        ON u.`iduser` = a.`user_iduser`
    WHERE a.`articlepublished` = 1
    ORDER BY a.`articledatepublished` DESC
    ;
    ";
    try{
        // requête
        $query = $connexion->query($sql);
        // récupération des résultats (tableau indexé, si 0 => [])
        $resultat = $query->fetchAll();
        // bonne pratique
        $query->closeCursor();
        // envoyer le résultat
        return $resultat;
    }catch(Exception $e){
        die($e->getMessage());
    }
}

function selectAllArticle(PDO $connexion):array
{
    $sql="
    SELECT a.`idarticle`, a.`title`, SUBSTR(a.`articletext`,1,80) AS articletext, a.`articlepublished`, a.`articledatepublished`,
           u.`login`
    FROM `article` a 
    LEFT JOIN `user` u 
        ON u.`iduser` = a.`user_iduser`
    ORDER BY a.`articlepublished` ASC, 
             a.`articledatepublished` DESC
    ;
    ";
    try{
        // requête
        $query = $connexion->query($sql);
        // récupération des résultats (tableau indexé, si 0 => [])
        $resultat = $query->fetchAll();
        // bonne pratique
        $query->closeCursor();
        // envoyer le résultat
        return $resultat;
    }catch(Exception $e){
        die($e->getMessage());
    }
}

function deleteArticle(PDO $connexion, int $id): bool
{
    // requête préparée
    $sql = "DELETE FROM `article` WHERE `idarticle`=?";
    $prepare = $connexion->prepare($sql);
    try{
        $prepare->execute([$id]);
        $prepare->closeCursor();
        return true;
    }catch(Exception $e){
        die($e->getMessage());
    }
}