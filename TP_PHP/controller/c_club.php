<?php
    require_once('model/club.php');
    require_once('model/gestionClub.php');
    
    $cnx = new PDO("pgsql:host=localhost;port=5432;dbname=DB_Ligue1;user=postgres;password=P@ssw0rdsio");
    $gestionClub = new gestionClub($cnx);

    $clubTab = $gestionClub->getListClub();

    include('view/listeClub.php');