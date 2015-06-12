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
				width: 48%;
				height: 80px;
				display: inline-block;
				margin-bottom: 15px;
				margin-right: 7px;

			}
			.userbox_header, .userbox_containt{
				width: 100%;
				height: 40px;
			}
			.userbox_header_green{
				background-color: #5CB85C;
				border-top-right-radius: 4px;
				border-top-left-radius: 4px;
			}
			.userbox_containt_green{
				background-color: #e7e7e7;
				border-bottom-right-radius: 4px;
				border-bottom-left-radius: 4px;
			}
			.userbox_header_red{
				background-color: rgb(217, 83, 79);
				border-top-right-radius: 4px;
				border-top-left-radius: 4px;
			}
			.userbox_containt_red{
				background-color: #e7e7e7;
				border-bottom-right-radius: 4px;
				border-bottom-left-radius: 4px;
			}
			.userbox_header_orange{
				background-color: rgb(240, 173, 78);
				border-top-right-radius: 4px;
				border-top-left-radius: 4px;
			}
			.userbox_containt_orange{
				background-color: #e7e7e7;
				border-bottom-right-radius: 4px;
				border-bottom-left-radius: 4px;
			}
			.userbox_header_blue{
				background-color: rgb(124, 77, 255);
				border-top-right-radius: 4px;
				border-top-left-radius: 4px;
			}
			.userbox_containt_blue{
				background-color: #e7e7e7;
				border-bottom-right-radius: 4px;
				border-bottom-left-radius: 4px;
			}
			.userbox_textinfo{
				width: 46.5%;
				color: white;
				display: inline-block;
				text-indent: 7%;
				margin-top: 9px;
				font-size: 18px;
			}
			.containt_textinfo{
				color: #33443A;
			}
			.userbox_hiddeninfo{
				display: none;
			}
    </style>
</head>
<body >
	<?php
		require_once("navbar.php");
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
			<div>
				<?php 
					if(isset($erreur))
						echo $erreur;
				?>
			</div>
		<h1>Gestion d'utilisateurs</h1>
			<a href="#" type="button" class="btn btn-primary" id='create'>Créer un enseignant</a>
			<a href="#" type="button" class="btn btn-danger hidden" id="delete">Supprimer l'enseignant</a>
			<br/><br/>
			<div class="hidden form" id="form_enseignant">
				
			</div>
			<br/><br/>
			<!--<table class='table table-bordered'>
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
				<tbody>-->
				<?php
					$i = 1;
					foreach ($enseignants as $enseignant) {
						/*echo '
						<tr class="tr_enseignant">
						<td>'.$i.'</td>
						<td class="nom">'.$enseignant["nom"].'</td>
						<td class="prenom">'.$enseignant["prenom"].'</td>
						<td class="login">'.$enseignant["login"].'</td>
						<td class="statut">'.$enseignant["statut"].'</td>';*/
						$pourcentage = $enseignant['nb_heure']/$enseignant['statutaire'];
						$class = "";
						$class2 = "";
						if($pourcentage < 0.3){
							$class = 'userbox_header_red';
							$class2 = 'userbox_containt_red';
						}
						else if($pourcentage < 0.6){
							$class = 'userbox_header_orange';
							$class2 = 'userbox_containt_orange';
						}
						else if($pourcentage < 1){
							$class = 'userbox_header_green';
							$class2 = 'userbox_containt_green';
						}
						else{
							$class = 'userbox_header_blue';
							$class2 = 'userbox_containt_blue';
						}
						echo '<div class="userbox_profil">
							<div class="'.$class.'">
								<p class="userbox_textinfo userbox_surname">'.$enseignant['nom'].'</p>
								<p class="userbox_textinfo userbox_name">'.$enseignant['prenom'].'</p>
							</div>
							<div class="'.$class2.'">
								<div class="userbox_hiddeninfo userbox_login">'.$enseignant['login'].'</div>
								<p class="userbox_textinfo containt_textinfo userbox_statut">'.$enseignant['statut'].'</p>
								<p class="userbox_textinfo containt_textinfo">'.$enseignant['nb_heure'].'/'.$enseignant['statutaire'].'</p>';

						if($enseignant["administrateur"] == 1){
							//echo '<td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
							echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
						}
						else{
							//echo '<td></td>';
							echo '</div></div>';
						}
						//echo '</tr>';
						$i = $i + 1;
					}
				?>
				<!--</tbody>
			</table>-->

		</article>
	</div>
		
	</section>
	<script>

    	//$(".tr_enseignant").click(function(){
    	$(".userbox_profil").click(function(){
    		console.log($(this));
    		//$(".tr_enseignant").each(function() {
    		$(".userbox_profil").each(function() {
    			$(this).removeClass('active');
    		});
    		$(this).addClass('active');
    		$("#delete").removeClass('hidden');
    		$("#form_enseignant").removeClass('hidden');
    		RemplirInput($(this));
    	});
		$("#create").click(function(){
			$("#form_enseignant").removeClass('hidden');
			$("#form_enseignant").html('<form action="utilisateurs/creer" method="post" accept-charset="utf-8" class="form-horizontal"><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="nom" placeholder="Nom" name="nom"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="login" placeholder="Identifiant" name="login"></div></div><div class="form-group"><div class="col-sm-10"><input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="statut" placeholder="statut" name="statut"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="statutaire" placeholder="Statutaire" name="statutaire"></div></div><div class="form-group"><div class=" col-sm-10"><div class="checkbox"><label><input type="checkbox" name="admin"> Administrateur</label></div></div></div><div class="form-group"><div class="col-sm-10"><button type="submit" class="btn btn-default">Soumettre</button></div></div></form>');
		});
		$("#delete").click(function(){
			window.location = "/utilisateurs/delete?login=" + $("input[name='login']").val();
		});

		function RemplirInput(_this){
			/*var nom = _this[0].children[1].innerHTML;
			var prenom = _this[0].children[2].innerHTML;
			var login = _this[0].children[3].innerHTML;
			var statut = _this[0].children[4].innerHTML;
			var admin = _this[0].children[5].innerHTML.length == 0 ? "" : "checked";*/
			var nom = _this.find('.userbox_surname').text();
			var prenom = _this.find('.userbox_name').text();
			var login = _this.find('.userbox_login').text();
			var statut = _this.find('.userbox_statut').text();
			var admin = _this.find('.glyphicon-ok').length == 0 ? "" : "checked";
			$("#form_enseignant").html('<form action="utilisateurs/modifier" method="post" accept-charset="utf-8" class="form-horizontal" id="form_modifier"><input type="hidden" name="login" value="' + login +'"><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="' + nom +'"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" value="' + prenom +'"></div></div><div class="form-group"><div class="col-sm-10"><input type="text" class="form-control" id="statut" placeholder="Statut" name="statut" value="' + statut + '"></div></div><div class="form-group"><div class=" col-sm-10"><div class="checkbox"><label><input type="checkbox" name="admin" ' + admin +'> Administrateur</label></div></div></div><div class="form-group"><div class="col-sm-10"><button type="submit" class="btn btn-default">Soumettre</button></div></div></form>');
		};
	</script>	
</body>