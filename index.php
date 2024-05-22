<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <header>
        <table border="0" class="header_title">
            <tr>
                <td>Site Ligue 1</td>
            </tr>
        </table>
        <table border="0" class="header_link">
            <tr>
                <td><a href="/accueil">Accueil</a></td>
                <td><a href="/clubs">Clubs</a></td>
                <td><a href="/article">Article</a></td>
                <?php
                session_start();

                if (isset($_SESSION['id'])) {
                    echo "<td><a href='/deconnexion'>Déconnexion</a></td>";
                } else {
                    echo "<td><a href='/inscription'>Inscription</a></td>";
                    echo "<td><a href='/connexion'>Connexion</a></td>";
                }
                ?>
            </tr>
        </table>
    </header>
</html>

<?php
    include('Router.php');

    $router = new Router();

    $router->addRoute("/accueil", "view/accueil.php");
    $router->addRoute("/clubs", "controller/c_club.php");
    $router->addRoute("/inscription", "controller/c_inscription.php");
    $router->addRoute("/gestionmdp", "view/gestionMDP.php");
    $router->addRoute("/article", "controller/c_article.php");
    $router->addRoute("/connexion", "controller/c_connexion.php");
    $router->addRoute("/deconnexion", "controller/c_deconnexion.php");

    $_SERVER["REQUEST_URI"];

    $router->execute($_SERVER["REQUEST_URI"]);

    $current_url = $_SERVER['REQUEST_URI'];
    if ($current_url == '/index.php') {
        header('Location: /accueil');
        exit();
    }
?>
