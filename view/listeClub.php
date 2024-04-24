<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table class="table_club">
            <tr class="clubrow1">
                <td>ID du club</td>
                <td>Nom du club</td>
                <td>Ligue du club</td>
            </tr>
            <?php
                $length = count($clubTab);

                for ($i = 0; $i < $length; $i++) {
                    echo "<tr class='clubrow2'>";
                    $club = $clubTab[$i]; // Obtenez l'objet Club à l'indice $i
                    echo "<td>" . $club->getIdClub() . "</td><td>" . $club->getNomClub() . "</td><td>" . $club->getLigue() . "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>