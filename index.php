<?php
	header('Content-Type: application/json;'); 
	header('Access-Control-Allow-Origin: *'); 
    require_once './controleurs/meteo.php';
    $controleurMeteo=new ControleurMeteo;

	switch($_SERVER['REQUEST_METHOD']) { 
		case 'GET': // GESTION DES DEMANDES DE TYPE GET 
			if(isset($_GET['id'])) { 
				// CODE PERMETTANT DE RÉCUPÉRER L'ENREGISTREMENT CORRESPONDANT À L'IDENTIFIANT PASSÉ EN PARAMÈTRE 
                $controleurMeteo->afficherFicheJSON($_GET['id']);
			} else { 
				// CODE PERMETTANT DE RÉCUPÉRER TOUT LES ENREGISTREMENTS 
                $controleurMeteo->afficherJSON();
			} 
			break; 
		case 'POST': // GESTION DES DEMANDES DE TYPE POST 
			// CODE PERMETTANT DE D'AJOUTER UN ENREGISTREMENT 
            $corpsJSON = file_get_contents('php://input'); 
            $data = json_decode($corpsJSON, TRUE);

            $controleurMeteo->ajouterJSON($data);
			break; 
		case 'PUT': // GESTION DES DEMANDES DE TYPE PUT 
			// CODE PERMETTANT DE METTRE À JOUR L'ENREGISTREMENT CORRESPONDANT À L'IDENTIFIANT PASSÉ EN PARAMÈTRE 
			$corpsJSON = file_get_contents('php://input'); 
			$data = json_decode($corpsJSON, TRUE);
			$controleurMeteo->modifierJSON($data);
			break; 
		case 'DELETE': // GESTION DES DEMANDES DE TYPE DELETE 
			// CODE PERMETTANT DE SUPPRIMER L'ENREGISTREMENT CORRESPONDANT À L'IDENTIFIANT PASSÉ EN PARAMÈTRE
			$controleurMeteo->supprimerJSON(); 
		break; 
		default: 
} 
?>

