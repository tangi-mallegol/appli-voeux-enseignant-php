<?php

	class contenu extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

	    //----------SELECT----------

	    function selectCoursEnFctModule($module){
	    	$sql = "SELECT * FROM contenu left join enseignant on enseignant=login WHERE module = ?;";
			return $this->db->query($sql, array($module))->result_array();
	    }

	    function selectCountCoursForLogin($login){
			$sql = "SELECT sum(hed) FROM contenu WHERE enseignant  = ?";
			return $this->db->query($sql, array($login))->result_array();
		}

	    function selectCoursModulePartie($module, $partie){
			$sql = "SELECT * FROM contenu WHERE module = ? AND partie = ?";
			return $this->db->query($sql, array($module, $partie))->result_array();
		}

	    function selectTousLesCours(){
			$sql = "SELECT * FROM contenu";
			return $this->db->query($sql)->result_array();
		}

		function selectTousLesTPs(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('TP'))->result_array();
		}

		function selectTousLesTDs(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('TD'))->result_array();
		}

		function selectTousLesCMs(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('CM'))->result_array();
		}

		function selectTousLesProjets(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('Projet'))->result_array();
		}

		function selectCours($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.enseignant  = ?";
			return $this->db->query($sql, array($login, $login))->result_array();
		}

		function selectTP($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.type = ? AND contenu.enseignant  = ?";
			return $this->db->query($sql, array('TP', $login))->result_array();
		}

		function selectTD($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.type = ? AND contenu.enseignant  = ?";
			return $this->db->query($sql, array('TD', $login))->result_array();
		}

		function selectCM($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.type = ? AND contenu.enseignant  = ?";
			return $this->db->query($sql, array('CM', $login))->result_array();
		}

		function selectProjet($login = null){
			$sql = "SELECT * FROM contenu, module WHERE contenu.type = ? AND contenu.enseignant  = ?";
			return $this->db->query($sql, array('Projet', $login))->result_array();
		}

		function selectCoursSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE enseignant IS NULL";
			return $this->db->query($sql, array(null))->result_array();
		}

		function selectTPSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('TP', null))->result_array();
		}

		function selectTDSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('TD', null))->result_array();
		}

		function selectCMSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('CM', null))->result_array();
		}

		function selectProjetSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('Projet', null))->result_array();
		}

		//-----------AJOUT-----------
		function ajoutContenu($module, $partie, $type, $hed, $enseignant = null){
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

		function GetNbHeureLibreProf($login){
			$sql = "SELECT enseignant.statutaire - decharge.decharge - SUM(contenu.hed) AS heure_restante,  decharge.decharge FROM decharge, enseignant, contenu WHERE contenu.enseignant = '$enseignant' && decharge.enseignant = 'vth$enseignantion' AND enseignant.login = '$enseignant'";
			return $this->db->query($sql)->result_array();
		}

		function addProfContenu($module, $partie, $enseignant){
			$sql = "SELECT * FROM contenu WHERE enseignant = '$enseignant' AND module = '$module' AND partie = '$partie'";
			$result = $this->db->query($sql)->result_array();
			if(count($result) == 0){
				$result = GetNbHeureLibreProf($login)
				//On a le prof qui est au dela de ses heures possible et comme il a une decharge, on lui refuse de prendre le cours
				if($result['heure_restante'] < 0 && $result['decharge'] > 0)
					return array("erreur" => true, "message" => "Impossible d'ajouter cet enseignant à ce contenu car il dépasserai son nombre d'heure autorisé. Pour plus d'informations, contactez un administrateur.");
				$sql = "UPDATE contenu SET enseignant = ? WHERE module = ? AND partie = ?";
				$result = $this->db->query($sql, array($enseignant, $module, $partie));	
				if(!$result)
					return array("erreur" => true, "message" => "Une erreur est survenu lors de l'assignation de cette partie à ce professeur, veuillez réessayer. Pour plus d'informations, contactez l'administrateur.");
			}else{
				return array("erreur" => true, "message" => "Un professeur est déjà assigné à ce module, contacter l'administrateur pour régler le problème.");
			}
		}

		function removeContenu($module, $partie){
 			$sql = "SELECT * FROM contenu WHERE module = '$module' AND partie = '$partie'";
 			$result = $this->db->query($sql)->result_array();
 			if(count($result) != 0){
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

		function ExportContenu($login = null){
			$this->load->helper('csv');
			if($login != null)
				return $this->db->query("SELECT module.ident as Identifiant, module.libelle as Libellé, module.semestre as Semestre, contenu.partie as Partie, contenu.hed as 'Heure(s) équivalent TD' FROM contenu NATURAL JOIN module WHERE contenu.module = module.ident && contenu.enseignant = $login ORDER BY module.ident, contenu.type, contenu.partie");
			else
				return $this->db->query("SELECT module.ident as Identifiant, module.libelle as Libellé, module.semestre as Semestre, contenu.partie as Partie, contenu.hed as 'Heure(s) équivalent TD' FROM contenu NATURAL JOIN module WHERE contenu.module = module.ident ORDER BY module.ident, contenu.type, contenu.partie");
		}
		
	}
?>
