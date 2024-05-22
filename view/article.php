<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="script/formscript.js"></script>
        <link rel="stylesheet" type="text/css" href="../style/style.css">
    </head>
    <body>
        <form method="post">
            <?php
            if(isset($_SESSION['id'])) {
                echo '<input type="text" id="saisie" name="saisie" class="commentInput" placeholder="Commentaire" required>';
                echo '<button type="commentsubmit" name="commentsubmit">Publier</input>';
            } else {
                echo "<h2>Veuillez vous connecter pour publier un commentaire.</h2>";
            }

            ?>
        </form>
    </body>
</html>