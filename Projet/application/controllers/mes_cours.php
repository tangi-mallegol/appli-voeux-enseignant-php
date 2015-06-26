<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Affichage des cours du prof
class Mes_cours extends MY_MainController {

	public function index()
	{
        //On verifie que l'utilisateur est loggué
        $this->filter_access();
        //On récupère le login en session pour le passer en paramètre aux fonctions de selection des cours
        $login = $_SESSION["login"];
        //On charge les modèles dont on aura besoin
        $this->load->model("contenu");
        $this->load->model("decharge");
        $this->load->model("module");
        //On initialise le tableau que l'on passera en paramètre de la vue
        $array["admin"] =  $_SESSION["admin"];
        $array["cours"] =  $this->contenu->selectCours($login);
        $array["TP"] =  $this->contenu->selectTP($login);
        $array["TD"] =  $this->contenu->selectTD($login);
		$array["CM"] =  $this->contenu->selectCM($login);
		$array["Projet"] =  $this->contenu->selectProjet($login);
		$array["Decharge"] =  $this->decharge->selectDechargeLogin($login);
		$array["module"] =  $this->module->selectModulesLoginAvecInfosEnseignant($login);
        //On charge la vue avec en paramètre le tableau de données que l'on as crée
        $this->load->view('mes_cours.php',$array);
	}

    //Fonction d'export Excel
	public function ExportContenu(){
        //On vérifie que l'utilisateur est bien loggué
        $this->filter_access();
        //On charge les modèles et les helpers dont on aura besoin
        $this->load->model("contenu");  
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        //On initialise les attributs de csv_from_result
        $delimiter = ";";
        $newline = "\r\n";
        header ("Content-disposition: attachment; filename=csvoutput_" . time() . ".csv") ;
        $data = $this->dbutil->csv_from_result($this->contenu->ExportContenu($_SESSION['login']), $delimiter, $newline);
        //On force le telechargement
        force_download("MesCours.csv", $data);
    }

    public function deconnexion(){
        session_destroy();
        $this->load->helper('url');
        redirect("/welcome");
    }
}
