<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
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
<article class="col-lg-12">
<table>
	<thead>
		<tr>
			<th>Partie</th>
			<th>Module</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
			<?php
				foreach($contenu as $row_contenu){
					echo "<tr><td>".$row_contenu->partie."</td>";
					echo "<td>".$row_contenu->module."</td></tr>";
				}
			?>	
		</tr>
	</tbody>
</table>

</article>
</section>

</body>