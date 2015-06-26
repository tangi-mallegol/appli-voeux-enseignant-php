<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tous_les_cours extends MY_MainController {

	public function index()
	{
        //On vérifie que l'utilisateur est bien loggué
        $module = !isset($_GET['module']) ? null : $_GET['module'];
        $this->filter_access();
            $array["admin"] =  $_SESSION["admin"];
            $login = $_SESSION["login"];
            //On charge les modèles dont on aura besoin
            $this->load->model("contenu");
            $this->load->model("user");
            $this->load->model("module");
            $array['login'] = $login;
        if(isset($module)){
            $array["enseignant"] =  $this->user->selectEnseignant();
            $array["modulesEnseignants"] =  $this->module->selectTousLesModulesAvecInfosEnseignant($module);
            for($i = 0; $i < count($array["modulesEnseignants"]); $i ++){
                $array["modulesEnseignants"][$i]["contenu"] = $this->contenu->selectCoursEnFctModule($array["modulesEnseignants"][$i]["ident"]);
            }
        }
        else{
            $array["enseignant"] =  $this->user->selectEnseignant();
            $array["modulesEnseignants"] =  $this->module->selectTousLesModulesAvecInfosEnseignant();
            for($i = 0; $i < count($array["modulesEnseignants"]); $i ++){
                $array["modulesEnseignants"][$i]["contenu"] = $this->contenu->selectCoursEnFctModule($array["modulesEnseignants"][$i]["ident"]);
            }
        }
        //On affiche les erreurs possible retournés par les fonctions de modification de données (add, remove, ...)
        if(isset($_SESSION['erreur'])){
            $array['erreur'] = $_SESSION['erreur'];
            unset($_SESSION['erreur']);
        }
        //On charge la vue de tous les cours et on lui passe en paramètre notre tableau de données
        $this->load->view('tous_les_cours.php',$array);
	}

    public function get_info_cours(){
        //On vérifie que l'utilisateur est bien loggué
        $this->filter_access();
        $module = $_GET['module'];
        //On charge les modèles dont on aura besoin
        $this->load->model("contenu");
        $array["listeCours"] = $this->contenu->selectCoursEnFctModule($module);
        $this->load->helper(array('form'));
        $this->load->view('pop_up_cours.php',$array);
    }

    public function createModule(){
        //On vérifie que l'utilisateur est bien loggué et que c'est un administrateur
        $this->filter_access(true);
        //On récupère en les données passées en paramètre
        $titre = $_GET['titre'];
        $ident = $_GET['ident'];
        $public = $_GET['public'];
        $semestre = $_GET['semestre'];
        //On charge les modèles dont on aura besoin
        $this->load->model("module");
        //On ajoute les données dans la BDD et on récupère un retour qui peut contenir une erreur si quelque chose s'est mal passé
        $result = $this->module->addModule($ident,$public,$semestre,$titre);
        //On vérifie si il n'y a pas eu une erreur dans l'execution de la requête
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        $this->load->helper('url');
        redirect("/tous_les_cours");
    }

    public function removeModule(){
        //On vérifie que l'utilisateur est bien loggué et que c'est un administrateur
        $this->filter_access(true);
        //On récupère le module passé en paramètre
        $ident = $_GET['module'];
        //On charge les modèles dont on aura besoin
        $this->load->model("module");
        //On supprime le module passé en paramètre
        $result = $this->module->removeModule($ident);
        //On vérifie si il n'y a pas eu une erreur dans l'execution de la requête
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        $this->load->helper('url');
        redirect("/tous_les_cours");
    }

    public function addPartie(){
        //On vérifie que l'utilisateur est bien loggué et que c'est un administrateur
        $this->filter_access(true);
        $module = $_GET['module'];
        $name = $_GET['name'];
        $type = $_GET['type'];
        $nb_heure = $_GET['nb_heure'];
        //On charge les modèles dont on aura besoin
        $this->load->model("contenu");
        //On ajoute une partie au module selectionné
        $result = $this->contenu->ajoutContenu($module,$name,$type,$nb_heure);
        //On vérifie si il n'y a pas eu une erreur dans l'execution de la requête
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        $this->load->helper('url');
        redirect("/tous_les_cours");
    }

    public function removePartie(){
        //On vérifie que l'utilisateur est bien loggué et que c'est un administrateur
        $this->filter_access(true);
        $module = $_GET['module'];
        $name = $_GET['name'];
        //$nb_heure = $_GET['nb_heure'];
        //On charge les modèles dont on aura besoin
        $this->load->model("contenu");
        //On supprime le cours liée (nom et module en clé primaire)
        $result = $this->contenu->removeContenu($module,$name);
        //On vérifie si il n'y a pas eu une erreur dans l'execution de la requête
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        $this->load->helper('url');
        redirect("/tous_les_cours");
    }


    public function ReserveCours(){
        //Si on passe un login, c'est que c'est l'administrateur qui reserve pour un compte sinon, c'est l'utilisateur lui-même
        $login = $_GET["login"];
        if(!isset($login))
            //On vérifie que l'utilisateur est bien loggué
            $this->filter_access();
        else
            //On vérifie que l'utilisateur est bien admin et loggué car il va modifier les cours d'un autre enseignant
            $this->filter_access(true);
        //On récupère le cours passé en paramètre
        $module = $_GET["module"];
        $partie = $_GET["partie"];
        //On charge les modèles dont on aura besoin
        $this->load->model("contenu");
        //On assigne le cours à un prof (si $login non null on passe le prof en paramètre)
        if($login != null)
            $result = $this->contenu->addProfContenu($module,$partie,$login);
        else
            $result = $this->contenu->addProfContenu($module,$partie,$_SESSION["login"]);
        //On vérifie si il n'y a pas eu une erreur dans l'execution de la requête
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        $this->load->helper('url');
        redirect("/tous_les_cours");
    }

    public function RemoveProf(){
        //On vérifie que l'utilisateur est bien loggué et que c'est un administrateur
        $this->filter_access(true);
        //On récupère le cours passé en paramètre
        $module = $_GET["module"];
        $partie = $_GET["partie"];
        //On charge les modèles dont on aura besoin
        $this->load->model("contenu");
        //On supprime l'assignation du prof au contenu
        $this->contenu->RemoveProfContenu($module,$partie);
        $this->load->helper('url');
        redirect("/tous_les_cours");
    }

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
        $data = mb_convert_encoding($this->dbutil->csv_from_result($this->contenu->ExportContenu(), $delimiter, $newline), "ISO-8859-1", "UTF-8");
        //On force le telechargement
        force_download("TousLesCours.csv", $data);
    }

}
