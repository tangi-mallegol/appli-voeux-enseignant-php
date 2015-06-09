<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tous_les_cours extends CI_Controller {

	public function index()
	{
        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        if(!isset($login)){
            $this->load->helper('url');
            redirect("/welcome");
        }
        $array["admin"] =  $_SESSION["admin"];
        $login = $_SESSION["login"];
        $this->load->model("contenu");
        $array["cours"] =  $this->contenu->selectTousLesCours();
        $array["TP"] =  $this->contenu->selectTousLesTPs();
        $array["TD"] =  $this->contenu->selectTousLesTDs();
        $array["CM"] =  $this->contenu->selectTousLesCMs();
        $array["cours_null"] =  $this->contenu->selectCoursSansEnseignant();
        $array["TP_null"] =  $this->contenu->selectTPSansEnseignant();
        $array["TD_null"] =  $this->contenu->selectTDSansEnseignant();
        $array["CM_null"] =  $this->contenu->selectCMSansEnseignant();
        $this->load->helper(array('form'));
        $this->load->view('tous_les_cours.php',$array);
	}

    public function get_info_cours($module, $partie){

        $this->load->model("contenu");
        $cours = $this->contenu->selectCoursModulePartie($module,$partie);
        return json_encode($cours);
    }
}