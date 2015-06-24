<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateurs extends MY_MainController {


	public function index($erreur = null)
	{
        //On vérifie que l'utilisateur est bien loggué et que c'est un administrateur
        $this->filter_access(true);
        $array["admin"] =  $_SESSION["admin"];
        if(isset($_SESSION["erreur"])){
            $array["erreur"] = $_SESSION["erreur"];
            unset($_SESSION["erreur"]);
        }
        //On charge les modèles dont on aura besoin
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
        //On vérifie que l'utilisateur est bien loggué et que c'est un administrateur
        $this->filter_access(true);
        //On récupère les données passées en paramètre
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $login = $_POST["login"];
        $password = $_POST["password"];
        $statut = $_POST["statut"];
        $decharge = $_POST["decharge"];
        $statutaire = intval($_POST["statutaire"]);
        //On regarde si l'utilisateur doit être actif ou admin
        $actif = isset($_POST["actif"]) ? 1 : 0;
        $admin = isset($_POST["admin"]) ? 1 : 0;
        //On charge les modèles dont on aura besoin
        $this->load->model("user");
        $this->load->model("decharge");
        //On essaye de creer l'utilisateur
        $result = $this->user->createUser($login,$password,$nom,$prenom,$statut,$statutaire,$admin,$actif);
        //On affiche l'erreur si il en existe une 
        if(isset($result['erreur']) && $result['erreur'] == true)
            $_SESSION['erreur'] = $result;
        //On ajoute la decharge ensuite
        $this->decharge->addDecharge($login,$decharge);
        $this->load->helper('url');
        redirect("/utilisateurs");
    }

    public function modifier(){
        //On vérifie que l'utilisateur est bien loggué et que c'est un administrateur
        $this->filter_access(true);
        //On récupère les données passées en paramètre
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $login = $_POST["login"];
        $statut = $_POST["statut"];
        $decharge = $_POST["decharge"];
        $admin = isset($_POST["admin"]) ? 1 : 0;
        $actif = isset($_POST["actif"]) ? 1 : 0;
        //On charge les modèles dont on aura besoin
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
        //On vérifie que l'utilisateur est bien loggué et que c'est un administrateur
        $this->filter_access(true);
        //On récupère les données passées en paramètre
        $login = $_GET["login"];
        //On charge les modèles dont on aura besoin
        $this->load->model("user");
        //On 'supprime' l'utilisateur, booléen supprime à 1
        $result = $this->user->deleteUser($login);
        $this->load->helper('url');
        redirect("/utilisateurs");
    }
}
