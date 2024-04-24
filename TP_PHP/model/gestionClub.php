<?php

class gestionClub {
    private PDO $cnx;

    public function __construct(PDO $cnx) {
        $this->cnx = $cnx;
    }

    function getListClub(): array {

        $resultTab = [];

        require_once('dbconnect.php');
        $query = "SELECT id_club, nom_club, ligue_club FROM club";
        $result = $this->cnx->query($query);
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $resultTab[] = new Club($row['id_club'], $row['nom_club'], $row['ligue_club']);
        }

        return $resultTab;
    }
}