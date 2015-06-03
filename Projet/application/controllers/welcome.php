<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index($erreur = null)
	{  
        if(isset($erreur))
            $array["erreur"] = "erreur";
        else 
            $array["erreur"] = "";
        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        if(isset($login)){
            $this->load_controller("home","index");
        }
        $this->load->helper(array('form'));
		$this->load->view('welcome_message',$array);
	}

    public function login(){
        if(isset($_POST["login"])){
            if(isset($_POST["password"])){
                $this->load->model("user");
                $user = $this->user->loginEnseignant($_POST["login"],$_POST["password"]);
                if(isset($user)){
                    //Authentification validée
                    $_SESSION["login"] = $user["login"];
                    $_SESSION["admin"] = $user["administrateur"];
                    $this->load->helper('url');
                    redirect("/home");
                }
                else
                {
                    //Erreur d'Authentification
                }
            }
        }
        //Champ mot de passe ou mail non trouvé
        else {
            $this->index($user);
        }
    }

    function load_controller($controller, $method = 'index')
    {
        require_once(FCPATH . APPPATH . 'controllers/' . $controller . '.php');
        $controller = new $controller();
        return $controller->$method();
    }
}