<?php
# controller/PrivateController.php
require_once "../model/UserModel.php";
require_once "../model/ArticleModel.php";
require_once "../view/homepage.html.php";


if (isset($_GET['page']) && $_GET['page'] === 'deconn') {
    require_once '../view/destruction.php';
}
if (isset($_GET['page']) && $_GET['page'] === 'admin') {
    require_once('../view/formulaire.html.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $articletext = $_POST['articletext'];
    $isPublished = isset($_POST['publish']) ? 1 : 0;
    $user_iduser = $_SESSION['user_id'] ?? 0;

    $publishedDate = null;
    if ($isPublished && !empty($_POST['articledatepublished'])) {
        $publishedDate = date('Y-m-d H:i:s', strtotime($_POST['articledatepublished']));
    }

    $success = insertArticleUnique($pdo, $title, $articletext, $isPublished, $publishedDate, $user_iduser);

    if ($success) {
        $_SESSION['success'] = "Article publié avec succès !";
    } else {
        $_SESSION['error'] = "Erreur lors de l'insertion de l'article.";
    }

    header('Location: ./');
    exit;
}

// var_dump($_SESSION);
