<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Vos Cours</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js" charset="utf-8"></script>
	<script src="../../Projet/asset/js/donut_chart.js"></script>
    <style>
			.chartSpace{
				width: 8	00px;
				height: 330px;
			}
			svg {
				width: 100%;
				height: 100%;
			}

			path.slice{
				stroke-width:2px;
			}

			polyline{
				opacity: .3;
				stroke: black;
				stroke-width: 2px;
				fill: none;
			}
			.module_btn{
				margin: 2px;
			}
    </style>
</head>
<body>
<?php
	require_once("navbar.php");
	showNavbar($admin);
?>
<section class="row">
	<div class="container">
		<article class="col-lg-9">
		<h1>Mes Cours</h1>
			<div class="chartSpace" id="ChartCours"></div>
			<?php

				// Display courses by type
				function displayCoursesInfo($sort){
					$sortTot = 0;
					$content = '';
					$tabSort =  $sort;
					foreach ($tabSort as $aSort){
						if($_SESSION["login"] == $aSort['enseignant']){
								$content = $content.'<a class="btn btn-primary module_btn" data-toggle="collapse" href="http://localhost/Projet/index.php/'.strtolower($aSort['module']).'"
												aria-expanded="false" aria-controls="collapseExample">'.$aSort['module'].'	: 	'.$aSort['hed'].'h</a>';
								$sortTot = $sortTot + $aSort['hed'];
						}
					}
					return array("total" => $sortTot, "content" => $content);
				}

				function displayCoursesBox($type, $typeTot){
					echo'<div class="type_box">';
						echo '<h3>Mes '.$type.'</h3>';
						if($typeTot['total'] > 0)
							echo $typeTot['content'];
						else
							echo "Vous n'avez pas d'heures de ".$type.".";
					echo'</div>';
				}

				// Display the CM courses and save the total of cm
				$CMTot = displayCoursesInfo($CM);
				displayCoursesBox('Cours Magistraux', $CMTot);

				// Display the TD courses and save the total of cm
				$TDTot = displayCoursesInfo($TD);
				displayCoursesBox('Travaux Dirigés', $TDTot);

				// Display the TP courses and save the total of cm
				$TPTot = displayCoursesInfo($TP);
				displayCoursesBox('Travaux Pratiques', $TPTot);

				$libreTot = 192 - ($CMTot['total'] + $TDTot['total'] + $TPTot['total']);
				$labelTab = ["CM (".$CMTot['total']." h)", "TD (".$TDTot['total']." h)", "TP (".$TPTot['total']." h)", "Libre (".$libreTot." h)"];
				$valueTab = [$CMTot['total'], $TDTot['total'], $TPTot['total'], $libreTot];

				//call the js function drawDonutChart
				echo '<script type="text/javascript">drawDonutChart('.json_encode($labelTab).','.json_encode($valueTab).');</script>';

			?>
		</article>
	</div>
</section>
</body>
