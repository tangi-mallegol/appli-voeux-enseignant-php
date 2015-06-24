<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mes_cours extends MY_MainController {

	public function index()
	{
        $this->filter_access();
        $array["admin"] =  $_SESSION["admin"];
        $login = $_SESSION["login"];
        $this->load->model("contenu");
        $array["cours"] =  $this->contenu->selectCours($login);
        $array["TP"] =  $this->contenu->selectTP($login);
        $array["TD"] =  $this->contenu->selectTD($login);
		$array["CM"] =  $this->contenu->selectCM($login);
		$array["Projet"] =  $this->contenu->selectProjet($login);
		$this->load->model("decharge");
		$array["Decharge"] =  $this->decharge->selectDechargeLogin($login);
		$this->load->model("module");
		$array["module"] =  $this->module->selectModulesLoginAvecInfosEnseignant($login);
        $this->load->helper(array('form'));
        $this->load->view('mes_cours.php',$array);
	}

	public function ExportContenu(){
        $this->filter_access();
        $this->load->model("contenu");  
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ";";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($this->contenu->ExportContenu($_SESSION['login']), $delimiter, $newline);
        force_download("TousLesCours.csv", $data);
    }
}
