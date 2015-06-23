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
        if(isset($_SESSION['erreur'])){
            $array['erreur'] = $_SESSION['erreur'];
            unset($_SESSION['erreur']);
        }
        $this->load->model("module");
        $array["modulesEnseignants"] =  $this->module->selectTousLesModulesAvecInfosEnseignant();    
        for($i = 0; $i < count($array["modulesEnseignants"]); $i ++){
            $array["modulesEnseignants"][$i]["contenu"] = $this->contenu->selectCoursEnFctModule($array["modulesEnseignants"][$i]["ident"]);
        }
        $this->load->helper(array('form'));
        $this->load->view('tous_les_cours.php',$array);
	}

    public function get_info_cours(){
        $this->filter_access();
        $module = $_GET['module'];
        //$partie = $_GET['partie'];
        $this->load->model("contenu");        
        $array["listeCours"] = $this->contenu->selectCoursEnFctModule($module);

        /*if(isset($cours[0]['enseignant'])){
            $this->load->model("user");
            $array['enseignant'] = $this->user->selectEnseignant($cours[0]['enseignant']);
        }*/
        /*if(isset($cours[0]['module']){
            $this->load->model("contenu");
            $array['module'] = $this->module->selectCoursModulePartie($module,$partie);
        }*/
        $this->load->helper(array('form'));
        $this->load->view('pop_up_cours.php',$array);
    }
    public function CreateModule(){
        $this->filter_access(true);
        $titre = $_GET['titre'];
        $ident = $_GET['ident'];
        $public = $_GET['public'];
        $semestre = $_GET['semestre'];
        $this->load->model("module");        
        $result = $this->module->addModule($ident,$public,$semestre,$titre);
        $this->load->helper('url');
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        redirect("/tous_les_cours");
    }

    public function removeModule(){
        $this->filter_access(true);
        $titre = $_GET['titre'];
        $ident = $_GET['ident'];
        $public = $_GET['public'];
        $semestre = $_GET['semestre'];
        $this->load->model("module");        
        $result = $this->module->removeModule($ident);
        $this->load->helper('url');
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        redirect("/tous_les_cours");
    }

    public function addPartie(){
        $this->filter_access(true);
        $module = $_GET['module'];
        $name = $_GET['name'];
        $type = $_GET['type'];
        $nb_heure = $_GET['nb_heure'];
        $this->load->model("contenu");        
        $result = $this->contenu->ajoutContenu($module,$name,$type,$nb_heure);
        $this->load->helper('url');
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        redirect("/tous_les_cours");
    }

    public function removePartie(){
        $this->filter_access(true);
        $module = $_GET['module'];
        $name = $_GET['name'];
        $nb_heure = $_GET['nb_heure'];
        $this->load->model("contenu");        
        $result = $this->contenu->removeContenu($module,$name,$type,$nb_heure);
        $this->load->helper('url');
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        redirect("/tous_les_cours");
    }


    public function ReserveCours($login = null){
        //Si on passe un login, c'est que c'est l'administrateur qui reserve pour un compte sinon, c'est l'utilisateur lui-même
        if($login = null)
            $this->filter_access();
        else
            $this->filter_access(true);
        $module = $_GET["module"];
        $partie = $_GET["partie"];
        $this->load->model("contenu");    
        if($login != null)
            $result = $this->contenu->addProfContenu($module,$partie,$login);
        else
            $result = $this->contenu->addProfContenu($module,$partie,$_SESSION["login"]);
        $this->load->helper('url');
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        redirect("/tous_les_cours");
    }

    public function RemoveProf(){
        $this->filter_access(true);
        $module = $_GET["module"];
        $partie = $_GET["partie"];
        $this->load->model("contenu");    
        $this->contenu->RemoveProfContenu($module,$partie);
        $this->load->helper('url');
        redirect("/tous_les_cours");
    }

    public function ExportContenu(){
        $this->load->model("contenu");  
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ";";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($this->contenu->ExportContenu(), $delimiter, $newline);
        force_download("TousLesCours.csv", $data);
    }

}