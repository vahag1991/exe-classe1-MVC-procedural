<?php
# controller/PublicController.php

// chargement des dépendances
require_once "../model/ArticleModel.php";

// chargement des articles
$articles = selectAllPlublishedArticle($db);

// chargement du template de l'accueil
require_once "../view/homepage.html.php";