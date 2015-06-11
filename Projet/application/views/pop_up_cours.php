<?php 

	echo "Module : ".$cours[0]['module'].'<br/>';
	echo "Partie : ".$cours[0]['partie'].'<br/>';
	echo "Type : ".$cours[0]['type'].'<br/>';
	echo "HED : ".$cours[0]['hed'].'<br/>';
	if(isset($enseignant)){
		echo "Prénom : ".$enseignant["prenom"].'<br/>';
		echo "Nom : ".$enseignant["nom"].'<br/>';
		echo "Statut : ".$enseignant["statut"].'<br/>';
	}
?>