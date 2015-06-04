<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gestion_cours extends CI_Controller {

	public function index($erreur = null)
	{
        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        if(!isset($login)){
            $this->load->helper('url');
            redirect("/welcome");
        }
        else if($_SESSION["admin"] = true){
            
        }
        else{
            $this->load->helper('url');
            redirect("/home");
        }
        /*$this->load->model("contenu");
        $array["contenu"] =  $this->contenu->selectCours($login);
        
        //Si c'est un administrateur
        if($_SESSION['admin'] = true){
            $this->load->model("user");
        }
        $this->load->helper(array('form'));
        $this->load->view('profil.php',$array);*/
	}

    public function creer(){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $login = $_POST["login"];
        $password = $_POST["password"];
        $statut = $_POST["statut"];
        $statutaire = $_POST["statutaire"];
        $admin = isset($_POST["admin"]) ? 1 : 0;
        $this->load->model("user");
        //$result = $this->user->createUser($login,$password,$nom,$prenom,$statut,$statutaire,$admin);
        $array["nom"] = $nom;
        $array["prenom"] = $prenom;
        $array["login"] = $login;
        $array["statut"] = $statut;
        $array["admin"] = $admin;
        $this->load->helper(array('form'));
        $this->load->view('result.php',$array);
    }

    public function modifier(){
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $login = $_POST["login"];
        $statut = $_POST["statut"];
        $admin = isset($_POST["admin"]) ? 1 : 0;
        $this->load->model("user");
        $array["nom"] = $nom;
        $array["prenom"] = $prenom;
        $array["login"] = $login;
        $array["statut"] = $statut;
        $array["admin"] = $admin;
        //$result = $this->user->setUser($login,$nom,$prenom,$statut,$admin);
        $this->load->helper(array('form'));
        $this->load->view('result.php',$array);
    }
}