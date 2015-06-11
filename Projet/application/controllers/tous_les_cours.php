<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tous_les_cours extends MY_MainController {

	public function index()
	{
        $this->filter_access();
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

    public function get_info_cours(){
        $module = $_GET['module'];
        $partie = $_GET['partie'];
        $this->load->model("contenu");
        $cours = $this->contenu->selectCoursModulePartie($module,$partie);
        $array["cours"] = $cours;
        if(isset($cours[0]['enseignant'])){
            $this->load->model("user");
            $array['enseignant'] = $this->user->selectEnseignant($cours[0]['enseignant']);
        }
        /*if(isset($cours[0]['module']){
            $this->load->model("contenu");
            $array['enseignant'] = $this->contenu->selectCoursModulePartie($module,$partie);
        }*/
        $this->load->helper(array('form'));
        $this->load->view('pop_up_cours.php',$array);
    }
}