<?php

	class user extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

		function selectEnseignant($login = null){
			if($login != null) return $this->db->get_where('enseignant', array('login' => $login))->result();	
			else return $this->db->get('enseignant')->result();
				
			/*if($login != null) return $bdd->query('SELECT * FROM enseignant WHERE login = \'$where\'')->fetch();
			else return $bdd->query('SELECT * FROM enseignant')->fetch();*/
		}

		function updateEnseignant(){

		}

		function changePwd($login, $password){
			//Le login permet de récupérer l'utilisateur
			//Le password est le nouveau mot de passe
			//$bdd->query("UPDATE 'enseignant' SET pwd = '$password' WHERE login = '$where'");
		}

		function loginEnseignant($login, $mdp){
			return $this->db->get_where('enseignant', array('login' => $login, 'pwd' => $mdp))->row_array();	
		}
	}

?>