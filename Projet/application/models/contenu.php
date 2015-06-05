<?php

	class contenu extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

	    //----------SELECT----------
		function selectCours($login){
			$sql = "SELECT * FROM contenu WHERE enseignant = ?";
			return $this->db->query($sql, array($login));
		}

		function selectTP($login){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant = ?";
			return $this->db->query($sql, array('TP', $login));
		}

		function selectTD($login){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant = ?";
			return $this->db->query($sql, array('TD', $login));
		}

		function selectCM($login){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant = ?";
			return $this->db->query($sql, array('CM', $login));
		}

		function selectCoursSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE enseignant = ?";
			return $this->db->query($sql, array(null));
		}

		function selectTPSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant = ?";
			return $this->db->query($sql, array('TP', null));
		}

		function selectTDSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant = ?";
			return $this->db->query($sql, array('TD', null));
		}

		function selectCMSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant = ?";
			return $this->db->query($sql, array('CM', null));
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