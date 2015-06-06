<!DOCTYPE html>
<html>
<head>
	<title>Utilisateurs</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <style>
			.userbox_profil, .userbox_header, .userbox_containt{
				margin: 0;
				padding: 0;
			}
			.userbox_profil{
				width: 49.5%;
				height: 80px;
				display: inline-block;
				margin-bottom: 5px;
			}
			.userbox_header, .userbox_containt{
				width: 100%;
				height: 40px;
			}
			.userbox_header{
				background-color: #449644;
				border-top-right-radius: 4px;
				border-top-left-radius: 4px;
			}
			.userbox_containt{
				background-color: #5CB85C;
				border-bottom-right-radius: 4px;
				border-bottom-left-radius: 4px;
			}
			.userbox_textinfo{
				width: 46.5%;
				color: #FFF;
				display: inline-block;
				text-indent: 7%;
				margin-top: 9px;
				font-size: 18px;
			}
			.userbox_hiddeninfo{
				display: none;
			}
			.glyphicon{
				cursor: pointer;
			}
    </style>
</head>
<body >
	<?php
		include("navbar.php");
		showNavbar($admin);
	?>
	<style type="text/css" media="screen">
		.tr_enseignant{
			cursor : pointer;
		}
	</style>
	<section class="row">
	<div class="container">
		<div class="col-lg-9">
		<h1>Gestion d'utilisateurs</h1>
			<a href="#" type="button" class="btn btn-primary" id='create'>Créer un enseignant</a>
			<a href="#" type="button" class="btn btn-danger hidden" id="delete">Supprimer l'enseignant</a>
			<br/><br/>
			<div class="hidden form" id="form_enseignant">

			</div>
			<br/><br/>
				<?php
					$i = 1;
					foreach ($enseignants as $enseignant) {
						echo '
						<div class="userbox_profil">
							<div class="userbox_header">
								<p class="userbox_textinfo userbox_surname">'.$enseignant->nom.'</p>
								<p class="userbox_textinfo userbox_name">'.$enseignant->prenom.'</p>
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</div>
							<div class="userbox_containt">
								<div class="userbox_hiddeninfo userbox_login">'.$enseignant->login.'</div>
								<p class="userbox_textinfo userbox_statut">'.$enseignant->statut.'</p>
								<p class="userbox_textinfo">150/192h</p>';
						if($enseignant->administrateur == 1){
							echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
						}
						echo '</div></div>';
						$i = $i + 1;
					}
				?>
		</article>
	</div>

	</section>
	<script>

    	$(".userbox_profil").click(function(){
    		console.log($(this));
    		$(".userbox_profil").each(function() {
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
		$("#delete").click(function(){
			window.location = "delete?login=" + $("input[name='login']").val();
		});

		function RemplirInput(_this){
			var nom = _this.find('.userbox_surname').text();
			var prenom = _this.find('.userbox_name').text();
			var login = _this.find('.userbox_login').text();
			var statut = _this.find('.userbox_statut').text();
			var admin = _this.find('.glyphicon-ok').length == 0 ? "" : "checked";
			$("#form_enseignant").html('<form action="utilisateurs/modifier" method="post" accept-charset="utf-8" class="form-horizontal" id="form_modifier"><input type="hidden" name="login" value="' + login +'"><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="' + nom +'"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" value="' + prenom +'"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="statut" placeholder="Statut" name="statut" value="' + statut + '"></div></div><div class="form-group"><div class=" col-sm-10"><div class="checkbox"><label><input type="checkbox" name="admin" ' + admin +'> Administrateur</label></div></div></div><div class="form-group"><div class="col-sm-10"><button type="submit" class="btn btn-default">Soumettre</button></div></div></form>');
		};
	</script>
</body>
