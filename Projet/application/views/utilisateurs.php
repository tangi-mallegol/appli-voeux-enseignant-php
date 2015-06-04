<!DOCTYPE html>
<html>
<head>
	<title>Utilisateurs</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <style>

    </style>
</head>
<body >
	<?php
		include("navbar.php");
		showNavbar($admin);
	?>
	<section class="row">
	<div class="container">
		<div class="col-lg-9">
		<h1>Gestion d'utilisateurs</h1>
			<a href="#" type="button" class="btn btn-primary" id='create'>Créer un enseignant</a>
			<a href="#" type="button" class="btn btn-success hidden" id="modifier">Modifier l'enseignant</a>
			<br/><br/>
			<div class="hidden form" id="form_enseignant">
				
			</div>
			<br/><br/>
			<table class='table table-bordered'>
				<thead>
					<tr>
						<th>#</th>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Identifiant</th>
						<th>Statut</th>
						<th>Administrateur</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$i = 1;
					foreach ($enseignants as $enseignant) {
						echo '
						<tr class="tr_enseignant">
						<td>'.$i.'</td>
						<td class="nom">'.$enseignant->nom.'</td>
						<td class="prenom">'.$enseignant->prenom.'</td>
						<td class="login">'.$enseignant->login.'</td>
						<td class="statut">'.$enseignant->statut.'</td>';
						if($enseignant->administrateur == 1){
							echo '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
						}
						else{
							echo '<td></td>';
						}
						echo '</tr>';
						$i = $i + 1;
					}
				?>
				</tbody>
			</table>
		</article>
	</div>
		
	</section>
	<script>

		form_modifier = ''
    	$(".tr_enseignant").click(function(){
    		console.log($(this));
    		$(".tr_enseignant").each(function() {
    			$(this).removeClass('active');
    		});
    		$(this).addClass('active');
    		$("#modifier").removeClass('hidden');
    		$("#form_enseignant").removeClass('hidden');
    		RemplirInput($(this));
    	});
		$("#create").click(function(){
			$("#form_enseignant").removeClass('hidden');
			$("#form_enseignant").html('<form action="utilisateurs/creer" method="post" accept-charset="utf-8" class="form-horizontal"><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="nom" placeholder="Nom" name="nom"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="login" placeholder="Identifiant" name="login"></div></div><div class="form-group"><div class="col-sm-10"><input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="statut" placeholder="statut" name="statut"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="statutaire" placeholder="Statutaire" name="statutaire"></div></div><div class="form-group"><div class=" col-sm-10"><div class="checkbox"><label><input type="checkbox" name="admin"> Administrateur</label></div></div></div><div class="form-group"><div class="col-sm-10"><button type="submit" class="btn btn-default">Soumettre</button></div></div></form>');
		});

		function RemplirInput(_this){
			var nom = _this[0].children[1].innerHTML;
			var prenom = _this[0].children[2].innerHTML;
			var login = _this[0].children[3].innerHTML;
			var statut = _this[0].children[4].innerHTML;
			var admin = _this[0].children[5].innerHTML.length == 0 ? "" : "checked";
			$("#form_enseignant").html('<form action="utilisateurs/modifier" method="post" accept-charset="utf-8" class="form-horizontal"><input type="hidden" name="login" value="' + login +'"><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="' + nom +'"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" value="' + prenom +'"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="statut" placeholder="Statut" name="statut" value="' + statut + '"></div></div><div class="form-group"><div class=" col-sm-10"><div class="checkbox"><label><input type="checkbox" name="admin" ' + admin +'> Administrateur</label></div></div></div><div class="form-group"><div class="col-sm-10"><button type="submit" class="btn btn-default">Soumettre</button></div></div></form>');
		};
	</script>	
</body>