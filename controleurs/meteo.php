<?php

require_once './modeles/meteo.php';

class ControleurMeteo{

    /***
     * Fonction permettant de récupérerer la météo afficher au format JSON
     */
    function afficherJSON() {
        $resultat = modele_meteo::ObtenirTous();
        echo json_encode($resultat);
    }
    
    

}