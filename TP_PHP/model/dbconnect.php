<?php
    $host = "localhost"; // Adresse IP ou nom du serveur PostgreSQL
    $port = "5432"; // Port PostgreSQL (par défaut : 5432)
    $dbname = "DB_Ligue1"; // Nom de la base de données PostgreSQL
    $user = "postgres"; // Nom d'utilisateur PostgreSQL
    $password = "P@ssw0rdsio"; // Mot de passe PostgreSQL

    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }