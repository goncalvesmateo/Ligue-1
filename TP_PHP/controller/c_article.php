<?php
require_once('model/dbconnect.php');

// Requette de l'article
$sql = "SELECT titre_news, article_news FROM NEWS;";
$requete = $pdo->prepare($sql);

try {
    // Exécution de la requête
    $requete->execute();
    // Récupération des résultats
    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des résultats sont renvoyés
    if (!$resultats) {
        die('Aucun résultat trouvé.');
    }
} catch (PDOException $e) {
    die('Erreur d\'exécution de la requête : ' . $e->getMessage());
}

foreach ($resultats as $resultat) {
    // Vérifier si les clés existent dans le tableau
    if (isset($resultat['titre_news']) && isset($resultat['article_news'])) {
        echo '<h2>' . $resultat['titre_news'] . '</h2>';
        echo '<p>' . $resultat['article_news'] . '</p>';
    } else {
        echo 'Clés manquantes dans le tableau.';
    }
}

echo '<h2>Commentaires</h2>';

// Requette des commentaires
$sql = "SELECT utilisateur.id_uti, nom_uti, prenom_uti, image_uti, commentaire.desc_com FROM utilisateur INNER JOIN commentaire ON commentaire.id_uti = utilisateur.id_uti;";
$requete = $pdo->prepare($sql);

try {
    // Exécution de la requête
    $requete->execute();
    // Récupération des résultats
    $resultats = $requete->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si des résultats sont renvoyés
    if (!$resultats) {
        die('Aucun résultat trouvé.');
    }
} catch (PDOException $e) {
    die('Erreur d\'exécution de la requête : ' . $e->getMessage());
}

foreach ($resultats as $resultat) {
    // Vérifier si les clés existent dans le tableau
    if (isset($resultat['nom_uti']) && isset($resultat['prenom_uti']) && isset($resultat['image_uti']) && isset($resultat['desc_com'])) {
        echo '<h3>' . $resultat['nom_uti'] . ' ' . $resultat['prenom_uti'] . '</h3>';
        $resultat['desc_com'] = strip_tags($resultat['desc_com']);
        echo '<p>' . $resultat['desc_com'] . '</p>';
    } else {
        echo 'Clés manquantes dans le tableau.';
    }
}

// Vérifie si le formulaire de commentaire a été soumis
if (isset($_POST['commentsubmit'])) {

    // Récupère les données du formulaire
    $saisie = isset($_POST['saisie']) ? $_POST['saisie'] : null;

    // Vérifie que les clés nécessaires sont définies
    if ($saisie !== null && !empty($saisie)) {
        // Remplacez les valeurs de id_news et id_uti par les valeurs appropriées
        $id_news = 1;
        $id_uti = $_SESSION['id'];

        $sql = "INSERT INTO commentaire (id_news, id_uti, desc_com) VALUES (:id_news, :id_uti, :saisie);";
        $requete = $pdo->prepare($sql);

        // Lie les valeurs aux paramètres de la requête.
        $requete->bindParam(':id_news', $id_news, PDO::PARAM_INT);
        $requete->bindParam(':id_uti', $id_uti, PDO::PARAM_INT);
        $requete->bindParam(':saisie', $saisie, PDO::PARAM_STR);
        $requete->execute();

        $pdo = null;

        // Redirection vers la même page après l'insertion
        header("Location: /article");
        exit();

        include('view/article.php');
    } else {
        include('view/article.php');
        echo "<p class='alert'>Veuillez remplir tous les champs du formulaire.</p>";
    }
} else {
    include('view/article.php');
}