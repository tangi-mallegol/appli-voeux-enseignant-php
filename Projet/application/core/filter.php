<?php

	function check_admin(){
		return $_SESSION["admin"];;
	}

	function check_connexion(){
		return isset($_SESSION["mail"]);
	}

?>