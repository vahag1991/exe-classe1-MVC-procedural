<?php
# model/ArticleModel.php

function selectAllPlublishedArticle(PDO $connexion):array
{
    $sql="
    SELECT a.`title`, a.`slug`, SUBSTR(a.`articletext`,1,250) AS articletext, a.`articledatepublished`,
           u.`login`, u.`username`
    FROM `article` a 
    JOIN `user` u 
        ON u.`iduser` = a.`user_iduser`
    WHERE a.`articlepublished` = 1
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
