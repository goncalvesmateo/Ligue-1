<?php
    class Club {
        private int $id_club;
        private String $nom_club;
        private String $ligue;

        public function __construct(int $id_club, String $nom_club, String $ligue) {
            $this->id_club = $id_club;
            $this->nom_club = $nom_club;
            $this->ligue = $ligue;
        }

        public function getIdClub(): int {
            return $this->id_club;
        }

        public function getNomClub(): String {
            return $this->nom_club;
        }

        public function getLigue(): String {
            return $this->ligue;
        }

        public function setIdClub(int $id_club): void {
            $this->id_club = $id_club;
        }

        public function setNomClub(String $nom_club): void {
            $this->nom_club = $nom_club;
        }

        public function setLigue(String $ligue): void {
            $this->ligue = $ligue;
        }

    }