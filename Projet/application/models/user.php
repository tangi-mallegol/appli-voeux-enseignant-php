<?php

	class user extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

		function selectEnseignant($login = null){
			if($login != null){
				//SELECT enseignant.login, enseignant.pwd, enseignant.nom, enseignant.prenom, enseignant.statut, enseignant.statutaire, enseignant.actif, enseignant.administrateur, enseignant.supprime, ifnull(decharge.decharge,0) as decharge FROM enseignant left join decharge on enseignant.login = decharge.enseignant
				$sql = "SELECT enseignant.login, enseignant.pwd, enseignant.nom, enseignant.prenom, enseignant.statut, enseignant.statutaire, enseignant.actif, enseignant.administrateur, enseignant.supprime, ifnull(decharge.decharge,0) as decharge FROM enseignant left join decharge on enseignant.login = decharge.enseignant WHERE enseignant.login = '$login' AND enseignant.supprime = 0";
    			return $this->db->query($sql)->result_array();
			}else{
				$sql = "SELECT enseignant.login, enseignant.pwd, enseignant.nom, enseignant.prenom, enseignant.statut, enseignant.statutaire, enseignant.actif, enseignant.administrateur, enseignant.supprime, ifnull(decharge.decharge,0) as decharge FROM enseignant left join decharge on enseignant.login = decharge.enseignant WHERE enseignant.supprime = 0";
    			return $this->db->query($sql)->result_array();
			}
		}

		function changePwd($login, $password){
			$result = $this->db->get_where('enseignant',array('login' => $login, 'supprime' => 0));
			if(isset($result) || empty($result)){
				//return fonction
				$this->db->update('enseignant',array('pwd' => $password),"login = '".$login."'");
			}
			else{
				return false;
			}
		}

		function loginEnseignant($login, $mdp){
			return $this->db->get_where('enseignant', array('login' => $login, 'pwd' => $mdp, 'supprime' => 0, 'actif' => 1))->row_array();	
		}

		function createUser($login, $password, $nom, $prenom, $statut, $statutaire, $administrateur, $actif){
			$result = $this->db->get_where('enseignant',array('login' => $login, 'supprime' => 0))->result_array();
			if(!isset($result) || empty($result))
				return $this->db->insert_batch('enseignant', array(array('login' => $login, 'pwd' => $password, 'nom' => $nom, 'prenom' => $prenom, 'statut' => $statut, 'statutaire' => $statutaire, 'supprime' => 0, 'actif' => $actif, 'administrateur' => $administrateur)));
			return false;
		}

		function setUser($login,$nom,$prenom,$statut,$admin,$actif){
			$result = $this->db->get_where('enseignant',array('login' => $login, 'supprime' => 0));
			if(isset($result) || empty($result)){
				//return fonction
				$this->db->update('enseignant',array('nom' => $nom, 'prenom' => $prenom, 'statut' => $statut, 'administrateur' => $admin, 'actif' => $actif),"login = '".$login."'");
			}
			else{
				return false;
			}
		}

		function deleteUser($login){
			$result = $this->db->get_where('enseignant',array('login' => $login, 'supprime' => 0));
			if(isset($result) || empty($result)){
				$this->db->update('enseignant',array('supprime' => '1'),"login = '".$login."'");
			}
			else{
				return false;
			}
		}
	}

?>