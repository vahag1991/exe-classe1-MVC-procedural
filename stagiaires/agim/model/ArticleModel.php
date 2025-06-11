<?php
# model/ArticleModel.php

function slugify(string $text): string
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    return strtolower(trim($text, '-')) ?: 'n-a';
}

function insertArticleUnique(PDO $pdo, string $title, string $articletext, int $isPublished, ?string $publishedDate, int $user_iduser): bool
{
    $baseSlug = slugify($title);
    $slug = $baseSlug;
    $i = 1;

    // Prépare la requête pour vérifier les slugs existants
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM article WHERE slug = ?");

    // Boucle pour trouver un slug unique
    while (true) {
        $checkStmt->execute([$slug]);
        if ($checkStmt->fetchColumn() == 0) {
            break;
        }
        $slug = $baseSlug . '-' . $i;
        $i++;
    }

    // Prépare l'insertion
    $insertStmt = $pdo->prepare("
        INSERT INTO article (title, slug, articletext, articledatecreated, articlepublished, articledatepublished, user_iduser) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $created = date('Y-m-d H:i:s');

    // Execute et retourne vrai ou faux selon réussite
    return $insertStmt->execute([
        $title,
        $slug,
        $articletext,
        $created,
        $isPublished,
        $publishedDate,
        $user_iduser
    ]);
}

// En COURS
// function getArticles(PDO $pdo, $slug, $title, $acticle){
//     $sql = "SELECT  FROM article";
//     $stmt = 
// }