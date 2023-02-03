<?php

include_once "./include/config.php";



class modele_meteo {
    public $id;
    public $ville;
    public $meteo; 
    public $condition;
   

    public function __construct($id, $ville, $meteo, $condition) {
        $this->id = $id;
        $this->ville = $ville;
        $this->meteo = $meteo;
        $this->condition = $condition;
    }

    

    static function connecter() {
        
        $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);

       // Vérifier la connexion
       if ($mysqli -> connect_errno) {
        http_response_code(500); // Envoi un code 500 au serveur
        $erreur = new stdClass();
        $erreur->message = "DEBOGAGE : Échec de connexion à la base de données MySQL: ";
        $erreur->error = $mysqli -> connect_error;
        echo json_encode($erreur);
        exit();
    } 


        return $mysqli;
    }


  // Fonction pour obtenir toute les météos

    public static function ObtenirTous() {
        $liste = [];
        $mysqli = self::connecter();

        $resultatRequete = $mysqli->query("SELECT * FROM meteo ORDER BY id;");

        foreach ($resultatRequete as $enregistrement) {
            $liste[] = new modele_meteo($enregistrement['id'], $enregistrement['ville'], $enregistrement['meteo'], $enregistrement['condition'] );
        }

        return $liste;
    }


}
?>