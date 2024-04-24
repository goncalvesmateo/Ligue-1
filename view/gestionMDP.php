<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../style/style.css">
    </head>
    <body>
        <select class="list" id="list" name="list">
            <option value="1">1. SHA1</option>;
            <option value="2">2. MD5</option>;
            <option value="3">3. Hash</option>;
            <option value="4">4. Crypt</option>;
            <option value="5">5. password_hash</option>;

            
            <div class="formulaire">
                <input type="text" id="mdphash" name="mdphash" placeholder="Mot de passe" required>
            </div>
            
            <form method="post">
                <div class="bouton">
                    <button type="submit" name="hash">Cliquez ici pour utiliser l'algorithme de hachage et de chiffrement afin de sécuriser et de protéger les données sensibles, telles que les mots de passe, en convertissant le mot de passe en une série de caractères alphanumériques indéchiffrables, rendant ainsi l'accès non autorisé pratiquement impossible</button>
                </div>
            </form>
        </select>
    </body>
</html>

<?php
if (isset($_POST['submit'])) {
    $mdphash = isset($_POST['mdphash']) ? $_POST['mdphash'] : null;
    if ($mdphash !== null) {
        echo "<p>Mot de passe : " . $mdphash . " </p>";
    } else {
        echo "<p>Aucun mot de passe saisi</p>";
    }
}
?>