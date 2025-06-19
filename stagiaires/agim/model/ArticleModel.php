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
function getArticles(PDO $pdo)
{
    $stmt = $pdo->prepare("SELECT title, articletext FROM article ORDER BY articledatecreated DESC");
    $stmt->execute();
    $articles = $stmt->fetchAll();
    $stmt->closeCursor();

    return $articles;
}

function getUnpublishedArticles(PDO $pdo)
{
    $stmt = $pdo->prepare("SELECT title, slug FROM article WHERE articlepublished = 0");
    $stmt->execute();
    $articles = $stmt->fetchAll();
    $stmt->closeCursor();

    return $articles;
}

function getArticleOrderByPublishedDesc(PDO $pdo): array
{
    $sql = "SELECT a.title, a.slug, a.articletext, a.articledatepublished, u.username
            FROM article a
            JOIN user u ON a.user_iduser = u.iduser
            WHERE a.articlepublished = 1
            ORDER BY a.articledatepublished DESC";

    try {
        $query = $pdo->prepare($sql);
        $query->execute();
        $articles = $query->fetchAll();
        $query->closeCursor();
        return $articles;
    } catch (Exception $e) {
        die('Erreur lors de la récupération des articles : ' . $e->getMessage());
    }
}

function getArticleBySlug(PDO $pdo, string $slug): ?array
{
    $sql = "SELECT a.title, a.slug, a.articletext, a.articledatepublished, u.username
            FROM article a
            JOIN user u ON a.user_iduser = u.iduser
            WHERE a.slug = :slug AND a.articlepublished = 1
            LIMIT 1";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['slug' => $slug]);
        $article = $stmt->fetch();
        $stmt->closeCursor();
        return $article ?: null;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}