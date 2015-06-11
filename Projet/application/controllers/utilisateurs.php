<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateurs extends MY_MainController {


	public function index($erreur = null)
	{
        /*$login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        if(!isset($login)){
            $this->load->helper('url');
            redirect("/welcome");
        }
        else if($_SESSION["admin"] = true){*/

        $this->filter_access(true);
        
        $array["admin"] =  $_SESSION["admin"];
        if(isset($_SESSION["erreur"])){
            $array["erreur"] = $_SESSION["erreur"];
            unset($_SESSION["erreur"]);
        }
        $this->load->model("user");
        $array["enseignants"] =  $this->user->selectEnseignant();
        $this->load->helper(array('form'));
        $this->load->view('utilisateurs.php',$array);
        /*}
        else{
            $this->load->helper('url');
            redirect("/home");
        }*/

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
        $this->filter_access(true);
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $login = $_POST["login"];
        $password = $_POST["password"];
        $statut = $_POST["statut"];
        try{
            $statutaire = intval($_POST["statutaire"]);
            $admin = isset($_POST["admin"]) ? 1 : 0;
            $this->load->model("user");
            $result = $this->user->createUser($login,$password,$nom,$prenom,$statut,$statutaire,$admin);
            $erreur = $result == false ? true : false;
            if($erreur)
                $_SESSION["erreur"] = $erreur;
        }
        catch(Exception $e){
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
        $admin = isset($_POST["admin"]) ? 1 : 0;
        $this->load->model("user");
        $array["nom"] = $nom;
        $array["prenom"] = $prenom;
        $array["login"] = $login;
        $array["statut"] = $statut;
        $array["admin"] = $admin;
        $result = $this->user->setUser($login,$nom,$prenom,$statut,$admin);
        $erreur = $result == false ? true : false;
        if($erreur)
            $_SESSION["erreur"] = $erreur;
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