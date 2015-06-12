<?php 
	echo "_________________________________________________________________________________________________________________________________________________________________";
	echo "<div class='row'><div class='col-md-1'>MODULE</div><div class='col-md-1'>PARTIE</div><div class='col-md-1'>TYPE</div><div class='col-md-1'>HED</div><div class='col-md-1'>ENSEIGNANT</div></div>";
	foreach($listeCours as $cours){
		echo "<div class='row'><div class='col-md-1'>".$cours["module"]."</div><div class='col-md-1'>".$cours["partie"]."</div><div class='col-md-1'>".$cours["type"]."</div><div class='col-md-1'>".$cours["hed"]."</div><div class='col-md-1'>".$cours["enseignant"]."</div></div>";
	}
	echo "_________________________________________________________________________________________________________________________________________________________________";
?>