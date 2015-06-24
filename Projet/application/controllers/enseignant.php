<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enseignant extends MY_MainController {

	public function index($erreur = null)
	{
        $this->filter_access();

        $enseignant = $this->uri->segment(2);
				$array["admin"] =  $_SESSION["admin"];
        $this->load->model("user");
        $array["enseignant"] = $enseignant;
				$this->load->model("contenu");
				$array["cours"] =  $this->contenu->selectCours($enseignant);
				$array["TP"] =  $this->contenu->selectTP($enseignant);
				$array["TD"] =  $this->contenu->selectTD($enseignant);
				$array["CM"] =  $this->contenu->selectCM($enseignant);
				$array["Projet"] =  $this->contenu->selectProjet($enseignant);
				$this->load->model("decharge");
				$array["Decharge"] =  $this->decharge->selectDechargeLogin($enseignant);
				$this->load->model("module");
				$array["module"] =  $this->module->selectModulesLoginAvecInfosEnseignant($enseignant);
				$this->load->helper(array('form'));
				$this->load->view('enseignant.php',$array);
	}
	public function ExportContenu(){
				$this->filter_access();
				$enseignant = $this->uri->segment(2);
				$this->load->model("contenu");
				$this->load->dbutil();
				$this->load->helper('file');
				$this->load->helper('download');
				$delimiter = ";";
				$newline = "\r\n";
				$data = $this->dbutil->csv_from_result($this->contenu->ExportContenu($enseignant), $delimiter, $newline);
				force_download("TousLesCours.csv", $data);
		}
}
