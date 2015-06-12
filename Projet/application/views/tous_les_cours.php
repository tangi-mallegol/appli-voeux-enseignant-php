<!DOCTYPE html>
<html>
<head>
	<title>Vos Cours</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <style>

    </style>
</head>
<body >
<?php
	require_once("navbar.php");
	showNavbar($admin);
?>
<section class="row">
<article class="col-lg-12">
<?php
	//Accès au tableau TP via : $TP
	//Accès au tableau TD via : $TD
	//Accès au tableau CM via : $CM
	//Accès au tableau Cours via : $cours
	//Accès au tableau TP qui n'ont pas de profs (pas encore selectionnés) via : $TP_null
	//Accès au tableau TD qui n'ont pas de profs (pas encore selectionnés) via : $TD_null
	//Accès au tableau CM qui n'ont pas de profs (pas encore selectionnés) via : $CM_null
	//Accès au tableau Cours qui n'ont pas de profs (pas encore selectionnés) via : $cours_null

	//Si envie de changer le nom des variables, go dans application/controllers/tous_les_cours.php, fonction adresse, changer l'index des tableaux

	//echo "<table>";
	//echo "<tr><th>Identifiant</th><th>Publique</th><th>Semestre</th><th>Libellé</th><th>Nom du responsable</th><th>Prénom du responsable</th><th>Statut du responsable</th></tr>";
	echo "<div class='row'><div class='col-md-1'>IDENTIFIANT</div><div class='col-md-2'>PUBLIQUE</div><div class='col-md-1'>SEMESTRE</div><div class='col-md-3'>LIBELLE</div><div class='col-md-1'>NOM</div><div class='col-md-2'>PRENOM</div><div class='col-md-1'>STATUT</div></div>";
	foreach($modulesEnseignants as $moduleEnseignant){
		//echo "<tr class='module' id='".$moduleEnseignant['ident']."'><td>".$moduleEnseignant['ident']."</td><td>".$moduleEnseignant['public']."</td><td>".$moduleEnseignant['semestre']."</td><td>".$moduleEnseignant['libelle']."</td><td>".$moduleEnseignant['nom']."</td><td>".$moduleEnseignant['prenom']."</td><td>".$moduleEnseignant['statut']."</td></tr><tr id='div_".$moduleEnseignant['ident']."'></tr>";
		echo "<div class='row module' id='".$moduleEnseignant['ident']."'><div class='col-md-1'>".$moduleEnseignant['ident']."</div><div class='col-md-2'>".$moduleEnseignant['public']."</div><div class='col-md-1'>".$moduleEnseignant['semestre']."</div><div class='col-md-3'>".$moduleEnseignant['libelle']."</div><div class='col-md-1'>".$moduleEnseignant['nom']."</div><div class='col-md-2'>".$moduleEnseignant['prenom']."</div><div class='col-md-1'>".$moduleEnseignant['statut']."</div></div><div id='div_".$moduleEnseignant['ident']."'></div>";
	}
	//echo "</table>"
?>

</article>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$(".module").click(function(){
			var id = $(this).attr("id");
			if($("#div_" + id).html() == ""){
				var url = "tous_les_cours/get_info_cours?module=" + id;
				$("#div_" + id).load("tous_les_cours/get_info_cours?module=" + id);
			}
			else{
				$("#div_" + id).html("");
			}
			
		});
	});
</script>
</body>