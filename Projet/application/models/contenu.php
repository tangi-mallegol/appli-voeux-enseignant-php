<?php

	class contenu extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

		function selectCours($login){
			return $this->db->get_where('contenu,enseignant', array('enseignant.login' => $login,'contenu.enseignant' => $login))->result();	
		}

		function selectTP($login){

		}

		function selectTD($login){

		}

		function selectCM($login){

		}
	}

?>