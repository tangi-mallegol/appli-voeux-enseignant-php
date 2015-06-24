<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateurs extends MY_MainController {


	public function index($erreur = null)
	{
        $this->filter_access(true);
        $array["admin"] =  $_SESSION["admin"];
        if(isset($_SESSION["erreur"])){
            $array["erreur"] = $_SESSION["erreur"];
            unset($_SESSION["erreur"]);
        }
        $this->load->model("user");
        $this->load->model("contenu");
        $array["enseignants"] =  $this->user->selectEnseignant();
		$i = 0;
        foreach ($array["enseignants"] as $key) {
            $x = $this->contenu->selectCountCoursForLogin($array["enseignants"][$i]["login"])[0]['sum(hed)'];
            $array["enseignants"][$i]["nb_heure"] = $x == NULL ? 0 : $x;
            $i ++;
        }
        if(isset($_SESSION['erreur'])){
            $array['erreur'] = $_SESSION['erreur'];
            unset($_SESSION['erreur']);
        }
        $this->load->helper(array('form'));
        $this->load->view('utilisateurs.php',$array);
	}

    public function creer(){
        $this->filter_access(true);
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $login = $_POST["login"];
        $password = $_POST["password"];
        $statut = $_POST["statut"];
        $decharge = $_POST["decharge"];
        try{
            $statutaire = intval($_POST["statutaire"]);
            $actif = isset($_POST["actif"]) ? 1 : 0;
            $admin = isset($_POST["admin"]) ? 1 : 0;
            $this->load->model("user");
            $result = $this->user->createUser($login,$password,$nom,$prenom,$statut,$statutaire,$admin,$actif);
            if(isset($result['erreur']) && $result['erreur'] == true)
                $_SESSION['erreur'] = $result;
            $this->load->model("decharge");
            $this->decharge->addDecharge($login,$decharge);
        }catch(Exception $e){
            $erreur = false;
            $_SESSION["erreur"] = $erreur;
        }
        $this->load->helper('url');
        redirect("/utilisateurs");
    }

    public function modifier(){
        $this->filter_access(true);
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $login = $_POST["login"];
        $statut = $_POST["statut"];
        $decharge = $_POST["decharge"];
        $admin = isset($_POST["admin"]) ? 1 : 0;
        $actif = isset($_POST["actif"]) ? 1 : 0;
        $this->load->model("user");
        $array["nom"] = $nom;
        $array["prenom"] = $prenom;
        $array["login"] = $login;
        $array["statut"] = $statut;
        $array["admin"] = $admin;
        $result = $this->user->setUser($login,$nom,$prenom,$statut,$admin,$actif);
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        $this->load->model("decharge");
            $this->decharge->addDecharge($login,$decharge);
        $this->load->helper('url');
        redirect("/utilisateurs");
        /*$this->load->helper(array('form'));
        $this->load->view('result.php',$array);*/
    }

    public function delete(){
        $this->filter_access(true);
        $login = $_GET["login"];
        $this->load->model("user");
        $result = $this->user->deleteUser($login);
        $erreur = $result == false ? true : false;
        if($erreur)
            $_SESSION["erreur"] = $erreur;
        $this->load->helper('url');
        redirect("/utilisateurs");
        /*$this->load->helper(array('form'));
        $this->load->view('result.php',$array);*/
    }
}
