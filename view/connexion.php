<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <h1>Connexion</h1>
        <form action="/connexion" method="post">
            <div class="formulaire">
                <input type="email" id="mail" name="mail" placeholder="Adresse mail" required>
            </div>
            <div class="formulaire">
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="bouton">
                <input type="submit" value="Se connecter" name="valider">
            </div>
        </form>
        
        <footer>
            <!-- Contenu du pied de page -->
        </footer>
    </body>
</html>