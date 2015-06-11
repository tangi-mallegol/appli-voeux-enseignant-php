<?php

	class user extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

		function selectEnseignant($login = null){
			if($login != null) return $this->db->get_where('enseignant', array('login' => $login, 'actif' => 1))->result_array();	
			else return $this->db->get_where('enseignant', array('actif' => 1))->result_array();
				
			/*if($login != null) return $bdd->query('SELECT * FROM enseignant WHERE login = \'$where\'')->fetch();
			else return $bdd->query('SELECT * FROM enseignant')->fetch();*/
		}

		function changePwd($login, $password){
			$result = $this->db->get_where('enseignant',array('login' => $login, 'actif' => 1));
			if(isset($result) || empty($result)){
				//return fonction
				$this->db->update('enseignant',array('pwd' => $password),"login = '".$login."'");
			}
			else{
				return false;
			}
		}

		function loginEnseignant($login, $mdp){
			return $this->db->get_where('enseignant', array('login' => $login, 'pwd' => $mdp, 'actif' => 1))->row_array();	
		}

		function createUser($login, $password, $nom, $prenom, $statut, $statutaire, $administrateur){
			$result = $this->db->get_where('enseignant',array('login' => $login, 'actif' => 1))->result_array();
			if(!isset($result) || empty($result))
				return $this->db->insert_batch('enseignant', array(array('login' => $login, 'pwd' => $password, 'nom' => $nom, 'prenom' => $prenom, 'statut' => $statut, 'statutaire' => $statutaire, 'actif' => true, 'administrateur' => $administrateur)));
			return false;
		}

		function setUser($login,$nom,$prenom,$statut,$admin){
			$result = $this->db->get_where('enseignant',array('login' => $login, 'actif' => 1));
			if(isset($result) || empty($result)){
				//return fonction
				$this->db->update('enseignant',array('nom' => $nom, 'prenom' => $prenom, 'statut' => $statut, 'administrateur' => $admin),"login = '".$login."'");
			}
			else{
				return false;
			}
		}

		function deleteUser($login){
			$result = $this->db->get_where('enseignant',array('login' => $login, 'actif' => 1));
			if(isset($result) || empty($result)){
				$this->db->update('enseignant',array('actif' => '0'),"login = '".$login."'");
			}
			else{
				return false;
			}
		}
	}

?>