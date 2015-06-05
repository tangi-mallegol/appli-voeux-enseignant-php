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

		function createUser($login, $password, $nom, $prenom, $statut, $statutaire, $administrateur){
			$result = $this->db->get_where('enseignant',array('login' => $login));
			if(!isset($result))
				return $this->db->insert_batch('enseignant', array(array('login' => $login, 'pwd' => $password, 'nom' => $nom, 'prenom' => $prenom, 'statut' => $statut, 'statutaire' => $statutaire, 'actif' => true, 'administrateur' => $administrateur)));
			return false;
		}

		function setUser($login,$nom,$prenom,$statut,$admin){
			$result = $this->db->get_where('enseignant',array('login' => $login));
			if(isset($result)){
				//return fonction
			}
			else{
				return false;
			}
		}

		function deleteUser($login){
			//On ne supprime pas
			//On met actif à 0
		}
	}

?>