<?php

	class module extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

	    //----------SELECT----------
	 	function selectTousLesModules(){
			$sql = "SELECT * FROM module";
			return $this->db->query($sql)->result_array();
		}

		function selectTousLesModulesAvecInfosEnseignant(){
			$sql = "select ident, public, semestre, libelle, nom, prenom, statut from module left join enseignant on responsable=login";
			return $this->db->query($sql)->result_array();
		}
		function selectModulesLoginAvecInfosEnseignant($login){
			$sql = "select module, type, hed, public from contenu join module on module=ident where enseignant = ?";
			return $this->db->query($sql, array($login))->result_array();
		}
	}
?>
