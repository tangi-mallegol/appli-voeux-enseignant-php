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
			$sql = "INSERT INTO contenu VALUES(?, ?, ?, ?, ?)";
			$this->db->query($sql, array($module, $partie, $type, $hed, $enseignant));
		}

		function addProfContenu($module, $partie, $enseignant){
			$sql = "UPDATE contenu SET enseignant = ? WHERE module = ? AND partie = ?";
			$this->db->query($sql, array($enseignant, $module, $partie));
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
	}
?>
