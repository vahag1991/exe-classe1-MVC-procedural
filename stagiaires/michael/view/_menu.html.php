<?php
// création des variables vides pour éviter l'erreur d'about
$activeHome = $activeAbout = $activeAdmin = "";
if(isset($_GET['pg'])){
    switch($_GET['pg']) {
        case "about":
            $activeAbout = "active";
            break;
        case "admin":
            $activeAdmin = "active";
            break;
    }
}else{
    $activeHome= "active";
}
?>
<ul class="navbar-nav nav me-auto ps-lg-5 mb-2 mb-lg-0">
    <li class="nav-item"><a class="nav-link scroll-link <?=$activeHome?>" aria-current="page" href="./">Accueil</a></li>
    <li class="nav-item"><a class="nav-link scroll-link <?=$activeAbout?>" href="./?pg=about">À propos</a></li>
    <?php
    // si connecté
    if(isset($_SESSION['login'])):
    ?>
        <li class="nav-item"><a class="nav-link scroll-link  <?=$activeAdmin?>" href="./?pg=admin">Administration</a></li>
        <li class="nav-item"><a class="nav-link scroll-link" href="./?pg=disconnect">Déconnexion de <?=$_SESSION['username']?></a></li>
    <?php
    // pas connecté
    else:
    ?>
    <li class="nav-item"><a class="nav-link scroll-link" href="./?pg=login">Connexion</a></li>
    <?php
    endif;
    ?>
</ul>
