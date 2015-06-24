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
				height: 330px;
				//width: 49%;
				//display: inline-block;
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
		<article class="col-lg-12">
			<article class="col-lg-6">
				<a class='btn btn-success' href='mes_cours/ExportContenu' >Export .csv</a>
			</article>
		</article>
		<article class="col-lg-12">

			<article class="col-lg-6">
				<h1>Mes Cours:</h1>
				<div class="chartSpace" id="ChartCours"></div>
			</article>
			<article class="col-lg-6">
				<h1>Mes Classes:</h1>
				<div class="chartSpace" id="ChartClasses"></div>
			</article>
				<?php

					// Display courses by type
					function displayCoursesInfo($sort, $class){
						$content = '';
						$tabClass = $class;
						$tabSort =  $sort;
						foreach ($tabClass as $aClass){
							$content = $content.'<h4>'.$aClass.'</h4>';
							foreach ($tabSort as $aSort){
								if($aSort['public'] == $aClass){
									$content = $content.'<a class="btn btn-primary module_btn" data-toggle="collapse" href="http://localhost/Projet/index.php/'.strtolower($aSort['module']).'"
													aria-expanded="false" aria-controls="collapseExample">'.$aSort['ident'].'	: 	'.$aSort['hed'].'h</a>';
								}
							}
						}
						return $content;
					}

					function displayDechargeInfoWithoutClass($sort){
						$content = '';
						$tabSort =  $sort;
						foreach ($tabSort as $aSort){
								$content = $content.'<a class="btn btn-primary module_btn" data-toggle="collapse" href="/"
												aria-expanded="false" aria-controls="collapseExample">'.$aSort['decharge'].'</a>';
						}
						return $content;
					}

					function displayProjetInfoWithoutClass($sort){
						$content = '';
						$tabSort =  $sort;
						foreach ($tabSort as $aSort){
								$content = $content.'<a class="btn btn-primary module_btn" data-toggle="collapse" href="http://localhost/Projet/index.php/'.strtolower($aSort['module']).'"
												aria-expanded="false" aria-controls="collapseExample">'.$aSort['module'].'	: 	'.$aSort['hed'].'h</a>';
						}
						return $content;
					}

					function getTotCoursesType($sort){
						$sortTot = 0;
						$tabSort =  $sort;
						foreach ($tabSort as $aSort)
							$sortTot = $sortTot + $aSort['hed'];
						return $sortTot;
					}

					function getTotDechargeType($sort){
						$sortTot = 0;
						$tabSort =  $sort;
						foreach ($tabSort as $aSort)
							$sortTot = $sortTot + $aSort['decharge'];
						return $sortTot;
					}

					function getTotByClass($sort, $class){
						$sortTot = 0;
						$tabClass = $class;
						$tabSort =  $sort;
						for($i=0; $i < count($tabClass); $i++){
							foreach ($tabSort as $aSort){
								if($aSort['public'] == $tabClass[$i])
									$sortTot = $sortTot + $aSort['hed'];
							}
							$tabClass[$i] = $sortTot;
						}
						return $tabClass;
					}

					function displayClassByType($sort){
						$sortTot = 0;
						$class = [];
						$tabSort =  $sort;
						foreach ($tabSort as $aSort){
								if(!(in_array($aSort['public'], $class)))
									array_push($class,$aSort['public']);
						}
						return $class;
					}

					function displayCoursesBox($type, $typeContent, $typeTot){
						echo'<article class="col-lg-6"><div class="type_box">';
							echo '<h2>Mes '.$type.'</h2>';
							if($typeTot > 0)
								echo $typeContent;
							else
								echo "Vous n'avez pas d'heures de ".$type.".";
						echo'</div></article>';
					}

					// Display the CM courses and save the total of cm
					$CMClass = displayClassByType($CM);
					$CMContent = displayCoursesInfo($CM, $CMClass);
					$CMTot = getTotCoursesType($CM);
					displayCoursesBox('Cours Magistraux', $CMContent, $CMTot);

					// Display the TD courses and save the total of cm
					$TDClass = displayClassByType($TD);
					$TDContent = displayCoursesInfo($TD, $TDClass);
					$TDTot = getTotCoursesType($TD);
					displayCoursesBox('Travaux Dirigés', $TDContent, $TDTot);

					// Display the TP courses and save the total of cm
					$TPClass = displayClassByType($TP);
					$TPContent = displayCoursesInfo($TP, $TPClass);
					$TPTot = getTotCoursesType($TP);
					displayCoursesBox('Travaux Pratiques', $TPContent, $TPTot);

					$ProjetContent = displayProjetInfoWithoutClass($Projet);
					$ProjetTot = getTotCoursesType($Projet);
					displayCoursesBox('Projets', $ProjetContent, $ProjetTot);

					$DechargeContent = displayDechargeInfoWithoutClass($Decharge);
					$DechargeTot = getTotDechargeType($Decharge);
					displayCoursesBox('Decharges', $DechargeContent, $DechargeTot);

					$coursClass = displayClassByType($cours);
					$coursClassTot = getTotByClass($cours, $coursClass);
					for($i=0; $i < count($coursClass); $i++){
						$coursClass[$i] = $coursClass[$i].' ('.$coursClassTot[$i].' h)';
					}

					$libreTot = 192 - ($CMTot + $TDTot + $TPTot);
					if($libreTot < 0)
						$libreTot = 0;
					$labelTab = ["CM (".$CMTot." h)", "TD (".$TDTot." h)", "TP (".$TPTot." h)", "Libre (".$libreTot." h)"];
					$valueTab = [$CMTot, $TDTot, $TPTot, $libreTot];

					//call the js function drawDonutChart
					echo '<script type="text/javascript">drawDonutChart('.json_encode($labelTab).','.json_encode($valueTab).', "#ChartCours");</script>';
					echo '<script type="text/javascript">drawDonutChart('.json_encode($coursClass).','.json_encode($coursClassTot).', "#ChartClasses");</script>';

				?>
		</article>
	</div>
</section>
</body>
