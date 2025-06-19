<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Document</title>
</head>

<body>
    <?php require_once('commons/header.php'); ?>

    <?php $nbrArticle = count($articlesOrderByPublishedDesc); ?>

    <div class="container mt-5">
        <?php if ($nbrArticle === 0): ?>
            <div class="alert alert-warning text-center">
                Pas encore d'articles publiés.
            </div>

        <?php elseif ($nbrArticle === 1): ?>
            <h4 class="mb-4 text-center">Il y a 1 article publié</h4>

        <?php else: ?>
            <h4 class="mb-4 text-center">Il y a <?= $nbrArticle ?> articles publiés</h4>
        <?php endif; ?>

        <?php if ($nbrArticle > 0): ?>
            <?php foreach ($articlesOrderByPublishedDesc as $article): ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>

                        <p class="card-text">
                            <?php if (isset($selectedSlug) && $selectedSlug === $article['slug']): ?>
                                <?= nl2br(htmlspecialchars($article['articletext'])) ?>
                                <br><a href="./" class="btn btn-sm btn-outline-secondary mt-3">← Replier l'article</a>
                            <?php else: ?>
                                <?= nl2br(htmlspecialchars(substr($article['articletext'], 0, 250))) ?>...
                                <a href="?page=<?= urlencode($article['slug']) ?>">Lire l'article</a>
                            <?php endif; ?>
                        </p>

                        <div class="d-flex justify-content-between text-muted mt-3">
                            <small>Publié le <?= date('d/m/Y à H:i', strtotime($article['articledatepublished'])) ?></small>
                            <small>Auteur : <?= htmlspecialchars($article['username']) ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>





    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3 text-center" role="alert">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3 text-center" role="alert">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

</body>

</html>