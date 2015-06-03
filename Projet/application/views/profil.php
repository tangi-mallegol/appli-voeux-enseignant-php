<!DOCTYPE html>
<html>
<head>
	<title>Master</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <style>

    </style>
</head>
<body >
<?php
	include("navbar.html");
?>
<section class="row">
<article class="col-lg-12">
<?php
	foreach($contenu as $row_contenu){
		echo "Type : ".$row_contenu->type;
		echo " / Module : ".$row_contenu->module;
		echo " / Classe : ".$row_contenu->module;
		echo '<br/>';
	}
?>
</article>
</section>

</body>