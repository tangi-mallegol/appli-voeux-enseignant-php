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

		function addModule($ident, $public, $semestre, $titre){
			$sql = "select * from module where ident = '$ident'";
			$result = $this->db->query($sql)->result_array();
			if(count($result) == 0){
				$sql = "insert into module values ('$ident','$public','$semestre','$titre',null)";
				return $this->db->query($sql);
			}else{
				return array("erreur" => true, "message" => "Cet identifiant de module existe déjà !");
			}
		}

		function ajoutContenu($module, $partie, $type, $hed, $enseignant = null){
 			$sql = "SELECT * FROM contenu WHERE module = '$module' AND partie = '$partie'";
 			$result = $this->db->query($sql)->result_array();
 			if(count($result) != 0){
 				return array("erreur" => true, "message" => "Ce module existe déjà !");
 			}else{
 				$sql = "INSERT INTO contenu VALUES(?, ?, ?, ?, ?)";
 				$this->db->query($sql, array($module, $partie, $type, $hed, $enseignant));
 			}
		}

		function ExportContenu(){
 			$this->load->helper('csv');
 			return $this->db->query("SELECT module.ident as Identifiant, module.libelle as Libellé, module.semestre as Semestre, contenu.partie as Partie, contenu.hed as 'Heure(s) équivalent TD' FROM contenu NATURAL JOIN module WHERE contenu.module = module.ident ORDER BY module.ident, contenu.type, contenu.partie");
 		}

		function selectModulesLoginAvecInfosEnseignant($login){
			$sql = "select module, type, hed, public from contenu join module on module=ident where enseignant = ?";
			return $this->db->query($sql, array($login))->result_array();

		}
	}
?>
