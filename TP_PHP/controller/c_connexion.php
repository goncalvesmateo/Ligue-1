<?php
require_once('model/dbconnect.php');

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    if (isset($_POST['valider'])) {
        require_once('model/dbconnect.php');

        try {
            // Récupérer les informations du formulaire
            $mail = $_POST['mail'];
            $password = $_POST['password'];

            // Vérifier les informations d'identification dans la base de données
            $query = "SELECT * FROM utilisateur WHERE mail_uti = :mail AND password_uti = :password";
            $requete = $pdo->prepare($query);
            $requete->bindParam(':mail', $mail);
            $requete->bindParam(':password', $password);
            $requete->execute();

            $userRow = $requete->fetch(PDO::FETCH_ASSOC);

            if ($requete->rowCount() == 1) {
                // L'utilisateur est authentifié avec succès
                $_SESSION['id'] = $userRow['id_uti'];
                header("Location: /");
                exit();
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données: " . $e->getMessage();
        }
    }
} else {
    include('view/connexion.php');
}
?>