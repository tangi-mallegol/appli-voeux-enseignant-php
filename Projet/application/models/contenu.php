<?php

	class contenu extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

	    //----------SELECT----------

	    function selectCoursModulePartie($module, $partie){
			$sql = "SELECT * FROM contenu WHERE module = ? AND partie = ?";
			return $this->db->query($sql, array($module, $partie))->row_array();
		}

	    function selectTousLesCours($login = null){
			$sql = "SELECT * FROM contenu";
			return $this->db->query($sql)->row_array();
		}

		function selectTousLesTPs($login = null){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('TP'))->row_array();
		}

		function selectTousLesTDs($login = null){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('TD'))->row_array();
		}

		function selectTousLesCMs(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('CM'))->row_array();
		}

		function selectCours($login = null){
			$sql = "SELECT * FROM contenu WHERE enseignant IS NOT NULL";
			return $this->db->query($sql, array($login))->row_array();
		}

		function selectTP($login = null){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NOT NULL";
			return $this->db->query($sql, array('TP', $login))->row_array();
		}

		function selectTD($login = null){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NOT NULL";
			return $this->db->query($sql, array('TD', $login))->row_array();
			
		}

		function selectCM($login = null){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NOT NULL";
			return $this->db->query($sql, array('CM', $login))->row_array();
		}

		function selectCoursSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE enseignant IS NULL";
			return $this->db->query($sql, array(null))->row_array();
		}

		function selectTPSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('TP', null))->row_array();
		}

		function selectTDSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('TD', null))->row_array();
		}

		function selectCMSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('CM', null))->row_array();
		}

		//-----------AJOUT-----------
		function ajoutContenu($module, $partie, $type, $hed, $enseignant){
			$sql = "INSERT INTO contenu VALUES(?, ?, ?, ?, ?)";
			$this->db->query($sql, array($module, $partie, $type, $hed, $enseignant));
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