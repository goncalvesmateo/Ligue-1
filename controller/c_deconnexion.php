<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion ou vers la page d'accueil
    header('Location: /connexion');
    exit(); // Terminer le script pour éviter toute exécution supplémentaire
}
?>