<?php
	//Classe donnant accès aux différentes données de la table "contenu"
	class contenu extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

	    //----------SELECT----------
		//Retourne un tableau contenant les contenus en fonction d'un module
	    function selectCoursEnFctModule($module){
	    	$sql = "SELECT * FROM contenu left join enseignant on enseignant=login WHERE module = ?;";
			return $this->db->query($sql, array($module))->result_array();
	    }

	    function selectCMEnFctModule($module){
	    	$sql = "SELECT * FROM contenu left join enseignant on enseignant=login WHERE module = ? AND type = 'CM';";
			return $this->db->query($sql, array($module))->result_array();
	    }

	    function selectTDEnFctModule($module){
	    	$sql = "SELECT * FROM contenu left join enseignant on enseignant=login WHERE module = ? AND type = 'TD';";
			return $this->db->query($sql, array($module))->result_array();
	    }

	    function selectTPEnFctModule($module){
	    	$sql = "SELECT * FROM contenu left join enseignant on enseignant=login WHERE module = ? AND type = 'TP';";
			return $this->db->query($sql, array($module))->result_array();
	    }

	    function selectProjetEnFctModule($module){
	    	$sql = "SELECT * FROM contenu left join enseignant on enseignant=login WHERE module = ? AND type = 'Projet';";
			return $this->db->query($sql, array($module))->result_array();
	    }

		//Retourne un tableau contenant les contenus en fonction d'un login
	    function selectCountCoursForLogin($login){
			$sql = "SELECT sum(hed) FROM contenu WHERE enseignant  = ?";
			return $this->db->query($sql, array($login))->result_array();
		}

		//Retourne un tableau contenant les contenus en fonction d'un module et d'une partie
	    function selectCoursModulePartie($module, $partie){
			$sql = "SELECT * FROM contenu WHERE module = ? AND partie = ?";
			return $this->db->query($sql, array($module, $partie))->result_array();
		}

		//Retourne un tableau contenant tous les contenus
	    function selectTousLesCours(){
			$sql = "SELECT * FROM contenu";
			return $this->db->query($sql)->result_array();
		}

		//Retourne un tableau contenant tous les "TP"
		function selectTousLesTPs(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('TP'))->result_array();
		}

		//Retourne un tableau contenant tous les "TD"
		function selectTousLesTDs(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('TD'))->result_array();
		}

		//Retourne un tableau contenant tous les "CM"
		function selectTousLesCMs(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('CM'))->result_array();
		}

		//Retourne un tableau contenant tous les "Projet"
		function selectTousLesProjets(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('Projet'))->result_array();
		}

		//Retourne un tableau contenant tous les contenus avec les modules associés en fonction d'un login
		function selectCours($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.enseignant  = ? AND contenu.module = module.ident";
			return $this->db->query($sql, array($login))->result_array();
		}

		//Retourne un tableau contenant tous les "TP" avec les modules associés en fonction d'un login
		function selectTP($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.type = ? AND contenu.enseignant  = ? AND contenu.module = module.ident";
			return $this->db->query($sql, array('TP', $login))->result_array();
		}

		//Retourne un tableau contenant tous les "TD" avec les modules associés en fonction d'un login
		function selectTD($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.type = ? AND contenu.enseignant  = ? AND contenu.module = module.ident";
			return $this->db->query($sql, array('TD', $login))->result_array();
		}

		//Retourne un tableau contenant tous les "CM" avec les modules associés en fonction d'un login
		function selectCM($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.type = ? AND contenu.enseignant  = ? AND contenu.module = module.ident";
			return $this->db->query($sql, array('CM', $login))->result_array();
		}

		//Retourne un tableau contenant tous les "Projet" avec les modules associés en fonction d'un login
		function selectProjet($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.type = ? AND contenu.enseignant  = ? AND contenu.module = module.ident";
			return $this->db->query($sql, array('Projet', $login))->result_array();
		}

		//Retourne un tableau contenant tous les contenus sans enseignant
		function selectCoursSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE enseignant IS NULL";
			return $this->db->query($sql, array(null))->result_array();
		}

		//Retourne un tableau contenant tous les "TP" sans enseignant
		function selectTPSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('TP', null))->result_array();
		}

		//Retourne un tableau contenant tous les "TD" sans enseignant
		function selectTDSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('TD', null))->result_array();
		}

		//Retourne un tableau contenant tous les "CM" sans enseignant
		function selectCMSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('CM', null))->result_array();
		}

		//Retourne un tableau contenant tous les "Projet" sans enseignant
		function selectProjetSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('Projet', null))->result_array();
		}

		//-----------AJOUT-----------
		//Permet d'ajouter un contenu
		function ajoutContenu($module, $partie, $type, $hed, $enseignant = null){
			//Si un champ n'est pas rempli (paramètre = null), un message d'erreur est envoyé
			if($partie == "")
				return array("erreur" => true, "message" => "Veuillez remplir le contenu.");
			if($hed == null || $hed <= 0 )
				return array("erreur" => true, "message" => "Veuillez saisir un nombre d'heure positif : ".$hed);
			//Si un contenu ayant le même module et la même partie existe : message d'erreur renvoyé (contenu déjà existant)
 			$sql = "SELECT * FROM contenu WHERE module = '$module' AND partie = '$partie'";
 			$result = $this->db->query($sql)->result_array();
 			if(count($result) != 0){
 				return array("erreur" => true, "message" => "Ce module existe déjà !");
 			}else{
 				$sql = "INSERT INTO contenu VALUES(?, ?, ?, ?, ?)";
 				$result = $this->db->query($sql, array($module, $partie, $type, $hed, $enseignant));
 				if(!result)
 					return array("erreur" => true, "message" => "Erreur lors de l'ajout du contenu.");
 			}
		}

		//Retourne un tableau contenant le nombre d'heure libre d'un enseignant
		function GetNbHeureLibreProf($login){
			$sql = "SELECT enseignant.statutaire - (ifnull(decharge.decharge,0) + ifnull(SUM(contenu.hed),0)) AS heure_restante,  ifnull(decharge.decharge,0) as decharge FROM contenu LEFT JOIN enseignant on contenu.enseignant = enseignant.login LEFT JOIN decharge on decharge.enseignant = contenu.enseignant WHERE contenu.enseignant = '$login'";
			return $this->db->query($sql)->result_array();
		}

		//Permet d'ajouter un enseignant à un contenu
		function addProfContenu($module, $partie, $enseignant){
			$sql = "SELECT * FROM contenu WHERE module = '$module' AND partie = '$partie'";
			$result = $this->db->query($sql)->result_array();
			if(count($result) == 0)
				return array("erreur" => true, "message" => "Aucun contenu trouvé pour ce nom de partie et ce nom de module.");
			if($result[0]['enseignant'] == null){
				$nb_heure_module = $result[0]['hed'];
				$result = $this->GetNbHeureLibreProf($enseignant);
				//On a le prof qui est au dela de ses heures possible et comme il a une decharge, on lui refuse de prendre le cours
				if( (int)$result[0]['heure_restante'] - (int)$nb_heure_module < 0 && (int)$result[0]['decharge'] > 0)
					return array("erreur" => true, "message" => "Impossible d'ajouter cet enseignant à ce contenu car il dépasserai son nombre d'heure autorisé. Pour plus d'informations, contactez un administrateur.");
				$sql = "UPDATE contenu SET enseignant = ? WHERE module = ? AND partie = ?";
				$result = $this->db->query($sql, array($enseignant, $module, $partie));
				if(!$result)
					return array("erreur" => true, "message" => "Une erreur est survenu lors de l'assignation de cette partie à ce professeur, veuillez réessayer. Pour plus d'informations, contactez l'administrateur.");
			}else{
				return array("erreur" => true, "message" => "Un professeur est déjà assigné à ce module, contacter l'administrateur pour régler le problème.");
			}
		}

		//Permet de supprimer un contenu
		function removeContenu($module, $partie){
 			$sql = "SELECT * FROM contenu WHERE module = '$module' AND partie = '$partie'";
 			$result = $this->db->query($sql)->result_array();
 			if(count($result) == 0){
 				return array("erreur" => true, "message" => "Ce module n'existe pas !");
 			}else{
 				$sql = "DELETE FROM contenu WHERE module = '$module' AND partie = '$partie'";
 				$result = $this->db->query($sql, array($module, $partie, $type, $hed, $enseignant));
 				if(!result)
 					return array("erreur" => true, "message" => "Erreur lors de la suppression du contenu.");
 			}
		}

		function RemoveProfContenu($module, $partie){
			$sql = "UPDATE contenu SET enseignant = NULL WHERE module = ? AND partie = ?";
			$this->db->query($sql, array($module, $partie));
		}

		//-----------CHECK-----------

		//Est ce qu'il y a un enseignant déjà selectionné pour ce module ?
		function checkEnseignant($module, $partie){
			$sql = "SELECT enseignant FROM contenue WHERE module=? AND partie=?";
			$val = $this->db->query($sql, array($module, $partie));
			return isset($val);
		}

		//----------EXPORT CSV---------

		//Permet de retourner un tableau "bien formé" pour construire le CSV
		function ExportContenu($login = null){
			if($login != null)
				return $this->db->query("SELECT module.ident as Identifiant, module.libelle as Libelle, module.semestre as Semestre, contenu.partie as Partie, contenu.hed as 'Heure(s) equivalent TD' FROM contenu NATURAL JOIN module LEFT JOIN enseignant ON contenu.enseignant = enseignant.login WHERE contenu.module = module.ident AND contenu.enseignant = '$login' ORDER BY module.ident, contenu.type, contenu.partie");
			else
				return $this->db->query("SELECT module.ident as Identifiant, module.libelle as Libelle, module.semestre as Semestre, contenu.partie as Partie, contenu.hed as 'Heure(s) equivalent TD', enseignant.prenom as Prenom, enseignant.nom as Nom FROM contenu NATURAL JOIN module LEFT JOIN enseignant ON contenu.enseignant = enseignant.login WHERE contenu.module = module.ident ORDER BY module.ident, contenu.type, contenu.partie");
		}

	}
?>
