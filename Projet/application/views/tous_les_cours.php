<!DOCTYPE html>
<html>
<head>
	<title>Vos Cours</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="../../Projet/asset/js/donut_chart.js"></script>
  <style>
		.module, .modulebox_header, .modulebox_containt, .modulebox_footer{
			margin: 0;
			padding: 0;
		}
		.module{
			width: 48%;
			min-height: 80px;
			display: inline-block;
			margin-bottom: 10px;
			margin-right: 10px;
			font-size: 16px;
		}
		.modulebox_header{
			background-color: #337AB7;
			border-top-right-radius: 4px;
			border-top-left-radius: 4px;
		}
		.modulebox_header p{
			width: 23%;
			color: #FFF;
			display: inline-block;
			text-indent: 7%;
			margin-top: 9px;
		}
		.modulebox_header p.public_text{
			width: 47%;
		}
		.modulebox_containt{
			padding: 3% 0 3% 0;
		}
		.modulebox_containt p{
			display: inline;
			margin-left: 7%;
			margin-top: 10px;
			margin-bottom: 10px;
		}
		.modulebox_footer{
			border-bottom-right-radius: 4px;
			border-bottom-left-radius: 4px;
			padding: 2%;
			overflow: hidden;
			min-height: 128px;
			/*height: 110px;
			max-height: 110px;*/
		}
		.modulebox_footer p{
			display: inline-block;
		}
		.modulebox_containt, .modulebox_footer{
			background-color: #E7E7E7;
			color: #33443A;
		}
		.btn-primary{
			margin: 1px;
		}
  </style>
</head>
<body >
<?php
	require_once("navbar.php");
	showNavbar($admin);
?>
<section class="row">
	<div class="container">
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

				//<div id='div_".$moduleEnseignant['ident']."'></div>";

				//echo "<table>";
				//echo "<tr><th>Identifiant</th><th>Publique</th><th>Semestre</th><th>Libellé</th><th>Nom du responsable</th><th>Prénom du responsable</th><th>Statut du responsable</th></tr>";
				//echo "<div class='row'><div class='col-md-1'>IDENTIFIANT</div><div class='col-md-2'>PUBLIQUE</div><div class='col-md-1'>SEMESTRE</div><div class='col-md-3'>LIBELLE</div><div class='col-md-1'>NOM</div><div class='col-md-2'>PRENOM</div><div class='col-md-1'>STATUT</div></div>";
				foreach($modulesEnseignants as $moduleEnseignant){
					//echo "<tr class='module' id='".$moduleEnseignant['ident']."'><td>".$moduleEnseignant['ident']."</td><td>".$moduleEnseignant['public']."</td><td>".$moduleEnseignant['semestre']."</td><td>".$moduleEnseignant['libelle']."</td><td>".$moduleEnseignant['nom']."</td><td>".$moduleEnseignant['prenom']."</td><td>".$moduleEnseignant['statut']."</td></tr><tr id='div_".$moduleEnseignant['ident']."'></tr>";
					echo "<div class='row module' id='".$moduleEnseignant['ident']."'>
									<div class='modulebox_header'>
										<p>".$moduleEnseignant['ident']."</p>
										<p class='public_text'>".$moduleEnseignant['public']."</p>
										<p>".$moduleEnseignant['semestre']."</p>
									</div>
									<div class='modulebox_containt'>
										<p>".$moduleEnseignant['libelle']."</p>
									</div>
									<div class='modulebox_footer'>";
										if($moduleEnseignant['nom'] != null){
											echo '<a class="btn btn-primary module_btn" data-toggle="collapse" href="http://localhost/Projet/index.php/'.$moduleEnseignant['nom'].'"
															aria-expanded="false" aria-controls="collapseExample">'.$moduleEnseignant['nom'].' 	'.$moduleEnseignant['prenom'].'</a>';
											echo '<a class="btn btn-primary module_btn" data-toggle="collapse" href="http://localhost/Projet/index.php/'.$moduleEnseignant['nom'].'"
															aria-expanded="false" aria-controls="collapseExample">'.$moduleEnseignant['nom'].' 	'.$moduleEnseignant['prenom'].'</a>';
											echo '<a class="btn btn-primary module_btn" data-toggle="collapse" href="http://localhost/Projet/index.php/'.$moduleEnseignant['nom'].'"
															aria-expanded="false" aria-controls="collapseExample">'.$moduleEnseignant['nom'].' 	'.$moduleEnseignant['prenom'].'</a>';
											echo '<a class="btn btn-primary module_btn" data-toggle="collapse" href="http://localhost/Projet/index.php/'.$moduleEnseignant['nom'].'"
															aria-expanded="false" aria-controls="collapseExample">'.$moduleEnseignant['nom'].' 	'.$moduleEnseignant['prenom'].'</a>';
											echo '<a class="btn btn-primary module_btn" data-toggle="collapse" href="http://localhost/Projet/index.php/'.$moduleEnseignant['nom'].'"
															aria-expanded="false" aria-controls="collapseExample">'.$moduleEnseignant['nom'].' 	'.$moduleEnseignant['prenom'].'</a>';

										}
					echo "	</div>
								</div>";

				}
				//echo "</table>"
			?>

		</article>
	</div>
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
