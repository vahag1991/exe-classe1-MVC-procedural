<?php 


session_start(); // Démarrer la session si elle existe
session_unset(); // Supprimer toutes les variables de session
session_destroy(); // Détruire la session
setcookie(session_name(), '', time() - 3600, '/'); // Supprimer le cookie de session

header('Location: ./'); // Redirection après la déconnexion
exit();