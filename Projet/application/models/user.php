<?php

	

	function selectEnseignant($login = null){
		//$bdd = new PDO('mysql:host=37.187.124.154;dbname=voeux;charset=utf8', 'sujet-php', 'sujet-php');
		if($login != null){
			return $bdd->query('SELECT * FROM enseignant WHERE login = \'$where\'')->fetch();
		}
		else{
			return $bdd->query('SELECT * FROM enseignant')->fetch();
		}
	}

	function updateEnseignant(){

	}

	function changePwd($login, $password){
		//Le login permet de récupérer l'utilisateur
		//Le password est le nouveau mot de passe
		$bdd->query("UPDATE 'enseignant' SET pwd = '$password' WHERE login = '$where'");
	}

?>