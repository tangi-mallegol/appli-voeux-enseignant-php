<?php

	class contenu extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

	    //----------SELECT----------

	    function selectTousLesCours($login = null){
			$sql = "SELECT * FROM contenu";
			return $this->db->query($sql);
		}

		function selectTousLesTPs($login = null){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('TP'));
		}

		function selectTousLesTDs($login = null){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('TD'));
		}

		function selectTousLesCMs(){
			$sql = "SELECT * FROM contenu WHERE type = ?";
			return $this->db->query($sql, array('CM'));
		}

		function selectCours($login = null){
			if(isset($login)){
				$sql = "SELECT * FROM contenu WHERE enseignant IS NOT NULL";
				return $this->db->query($sql, array($login));
			}
			else{
				$sql = "SELECT * FROM contenu";
				return $this->db->query($sql);
			}
		}

		function selectTP($login = null){
			if(isset($login)){
				$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NOT NULL";
				return $this->db->query($sql, array('TP', $login));
			}
			else{
				$sql = "SELECT * FROM contenu WHERE type = ?";
				return $this->db->query($sql, array('TP'));
			}
		}

		function selectTD($login = null){
			if(isset($login)){
				$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NOT NULL";
				return $this->db->query($sql, array('TD', $login));
			}
			else{
				$sql = "SELECT * FROM contenu WHERE type = ?";
				return $this->db->query($sql, array('TD'));
			}
		}

		function selectCM($login = null){
			if(isset($login)){
				$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NOT NULL";
				return $this->db->query($sql, array('CM', $login));
			}
			else{
				$sql = "SELECT * FROM contenu WHERE type = ?";
				return $this->db->query($sql, array('CM'));
			}
		}

		function selectCoursSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE enseignant IS NULL";
			return $this->db->query($sql, array(null));
		}

		function selectTPSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('TP', null));
		}

		function selectTDSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
			return $this->db->query($sql, array('TD', null));
		}

		function selectCMSansEnseignant(){
			$sql = "SELECT * FROM contenu WHERE type = ? AND enseignant IS NULL";
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