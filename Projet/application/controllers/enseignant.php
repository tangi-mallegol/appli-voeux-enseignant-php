<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Controller qui permet de voir les cours qu'un professeur a pris
class Enseignant extends MY_MainController {

	public function index($erreur = null)
	{
		//On vérifie que l'utilisateur est loggué
        $this->filter_access();
        //On récupère l'enseignant passé en paramètre
        $enseignant = $this->uri->segment(2);
		$array["admin"] =  $_SESSION["admin"];
		//On charge les models dans le controller
        $this->load->model("contenu");
        $this->load->model("decharge");
        $this->load->model("module");
        //On met les variables dont on aura besoin dans un array
        $array["enseignant"] = $enseignant;
		$array["cours"] =  $this->contenu->selectCours($enseignant);
		$array["TP"] =  $this->contenu->selectTP($enseignant);
		$array["TD"] =  $this->contenu->selectTD($enseignant);
		$array["CM"] =  $this->contenu->selectCM($enseignant);
		$array["Projet"] =  $this->contenu->selectProjet($enseignant);
		$array["Decharge"] =  $this->decharge->selectDechargeLogin($enseignant);
		$array["module"] =  $this->module->selectModulesLoginAvecInfosEnseignant($enseignant);
		//On charge la vue enseignant avec en paramètre le tableau de données que l'on a alimenté 
		$this->load->view('enseignant.php',$array);
	}

}
