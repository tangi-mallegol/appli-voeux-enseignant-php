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
			width: 100%;
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
		.modulebox_containt a{
			float:right;
			margin-right:15px;
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
		table {
        border-collapse: separate;
        border-spacing: 10px 5px;
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
			if(isset($erreur)){
				echo '<div class="alert alert-danger" role="alert">'.$erreur["message"].'</div>';
			}
			echo "<div class='col-lg-9' style='margin-bottom:20px'>";
			if(isset($admin) && $admin == true){
				echo "
				<button id='buton_add_module' class='btn btn-primary'>Ajouter un module</button>";
			}
			echo "<a href='/tous_les_cours/ExportContenu' class='btn btn-success'>Export .csv</a></div>"

		?>
		<div class='col-lg-9' style='margin-bottom:20px;' id='add_module'>

			<h3>Ajout de Module</h3>
			<form action="/tous_les_cours/createmodule" method="get" accept-charset="utf-8">
			<div class='form-group'>
			<label for="title">Libelle du module</label>
				<input class='form-control' type="text" name="titre" value="" placeholder="Nom">
			</div>
			
			<div class='form-group'>
				<label for="title">Identifiant du module</label>
				<input class='form-control' type="text" name="ident" value="" placeholder="Identifiant">
			</div>
			
			<div class='form-group'>
				<label for="title">Public</label>
				<input class='form-control' type="text" name="public" value="" placeholder="Public">
			</div>
			
			<div class='form-group'>
			<label for="Title">Selestre</label>
				<select name="semestre" class="form-control">
					<option value="S1">Semestre 1</option>
					<option value="S2">Semestre 2</option>
				</select>
			</div>

			<button type="submit" class="btn btn-default">Valider</button>
		</form>
		</div>
		
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

			$i = 0;
			echo "<div class='col-md-6'>";
			for($i = 0; $i < count($modulesEnseignants) ; $i ++){
				if($i%2 == 0){
					echo "<div class='row module' id='".$modulesEnseignants[$i]['ident']."'>
									<div class='modulebox_header'>
										<p>".$modulesEnseignants[$i]['ident']."</p>
										<p class='public_text'>".$modulesEnseignants[$i]['public']."</p>
										<p>".$modulesEnseignants[$i]['semestre']."</p>
									</div>
									<div class='modulebox_containt'>
										<p>".$modulesEnseignants[$i]['libelle']."</p>";
									if(isset($admin) && $admin == true){
										echo "<button class='btn btn-danger ajouter_partie' href=''>Ajouter une partie</button>";
									}
									echo "</div>
									<div class='modulebox_footer'>
									<table cellspacing='10px'>";

									foreach ($modulesEnseignants[$i]["contenu"] as $contenu) {
										if(!empty($contenu["nom"])){
											echo "<tr><td><label>".$contenu["partie"]." (".$contenu["hed"]." h) : &nbsp;</label></td>";
											echo '<td><a class="btn btn-default module_btn" href="http://localhost/Projet/index.php/enseignant/'.$contenu['login'].'"
															aria-expanded="false" aria-controls="collapseExample">'.$contenu['nom'].' 	'.$contenu['prenom'].'</a>&nbsp;&nbsp;<a href="tous_les_cours/RemoveProf?module='.$modulesEnseignants[$i]['ident'].'&partie='.$contenu["partie"].'" class="btn btn-warning"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td></tr>';

										}
										else{
											echo "<tr><td><label>".$contenu["partie"]." (".$contenu["hed"]." h) : &nbsp;</label></td>";
											echo '<td><a href="tous_les_cours/ReserveCours?module='.$modulesEnseignants[$i]['ident'].'&partie='.$contenu["partie"].'" class="btn btn-success module_btn"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Reservez cette partie</a></td></tr>';
										}
										//echo "<br/><br/>";
									}
					echo "	</table></div>
								</div>";
				}
				
			}
			echo "</div>";

			echo "<div class='col-md-6'>";
			for($i = 0; $i < count($modulesEnseignants) ; $i ++){
				if($i%2 == 1){
					echo "<div class='row module' id='".$modulesEnseignants[$i]['ident']."'>
									<div class='modulebox_header'>
										<p>".$modulesEnseignants[$i]['ident']."</p>
										<p class='public_text'>".$modulesEnseignants[$i]['public']."</p>
										<p>".$modulesEnseignants[$i]['semestre']."</p>
									</div>
									<div class='modulebox_containt'>
										<p>".$modulesEnseignants[$i]['libelle']."</p>";
									if(isset($admin) && $admin == true){
										echo "<button class='btn btn-danger ajouter_partie' href=''>Ajouter une partie</button>";
									}
									echo "</div>
									<div class='modulebox_footer'>
									<table cellspacing='10px'>";
									foreach ($modulesEnseignants[$i]["contenu"] as $contenu) {
										if(!empty($contenu["nom"])){
											echo "<tr><td><label>".$contenu["partie"]." (".$contenu["hed"]." h) : &nbsp;</label></td>";
											echo '<td><a class="btn btn-default module_btn" href="http://localhost/Projet/index.php/enseignant/'.$contenu['login'].'"
															aria-expanded="false" aria-controls="collapseExample">'.$contenu['nom'].' 	'.$contenu['prenom'].'</a>&nbsp;&nbsp;<a href="tous_les_cours/RemoveProf?module='.$modulesEnseignants[$i]['ident'].'&partie='.$contenu["partie"].'" class="btn btn-warning"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td></tr>';
										}
										else{
											echo "<tr><td><label>".$contenu["partie"]." (".$contenu["hed"]." h) : &nbsp;</label></td>";
											echo '<td><a href="tous_les_cours/ReserveCours?module='.$modulesEnseignants[$i]['ident'].'&partie='.$contenu["partie"].'" class="btn btn-success module_btn"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Reservez cette partie</a></td></tr>';
										}
										//echo "<br/><br/>";
									}
					echo "	</table></div>
								</div>";
				}
			}
			echo "</div>";
				/*foreach($modulesEnseignants as $moduleEnseignant){
					//echo "<tr class='module' id='".$moduleEnseignant['ident']."'><td>".$moduleEnseignant['ident']."</td><td>"
					.$moduleEnseignant['public']."</td><td>".$moduleEnseignant['semestre']."</td><td>".$moduleEnseignant['libelle'].
					"</td><td>".$moduleEnseignant['nom']."</td><td>".$moduleEnseignant['prenom']."</td><td>".$moduleEnseignant['statut']
					."</td></tr><tr id='div_".$moduleEnseignant['ident']."'></tr>";
					

				}
				//echo "</table>"*/
			?>

		</article>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$("#add_module").hide();
		$("#buton_add_module").click(function(){
			$("#add_module").show(200);
			$("#buton_add_module").hide();
		});
		/*$(".module").click(function(){
			var id = $(this).attr("id");
			if($("#div_" + id).html() == ""){
				var url = "tous_les_cours/get_info_cours?module=" + id;
				$("#div_" + id).load("tous_les_cours/get_info_cours?module=" + id);
			}
			else{
				$("#div_" + id).html("");
			}

		});*/
		$(".ajouter_partie").click(function(){
			var id = $(this).parent().parent().attr("id");
			console.log(id);
			$(this).html("Confirmer");
			$(this).removeClass('ajouter_partie');
			$(this).addClass('confirmer_ajout');
			$(this).parent().html($(this).parent().html() + "<div style='margin-left:20px'><br/><br/><label for='title'>Nom&nbsp;</label><input type='text' name='nom'><br/><label for='title'>Type&nbsp;</label><select name='type'><option value='CM'>CM</option><option value='TD'>TD</option><option value='TP'>TP</option></select><br/><label for='title'>Nombre d'heure&nbsp;</label><input type='number' name='nb_heure'><br/></div>");

			$(".confirmer_ajout").click(function(){
				console.log("test");
				var name = $(this).parent().children().children('input[name=\'nom\']').val();
				var type = $(this).parent().children().children('select[name=\'type\']').val();
				var nb_heure = $(this).parent().children().children('input[name=\'nb_heure\']').val();
				window.location = "tous_les_cours/addPartie?module=" + id + "&name=" + name + "&type=" + type + "&nb_heure=" + nb_heure;
			});
		});


	});
</script>
</body>
