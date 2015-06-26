<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_MainController {

	public function index($erreur = null)
	{  
        if(isset($erreur))
            $array["erreur"] = "erreur";
        else 
            $array["erreur"] = "";
        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        //On vérifie que l'utilisateur est bien loggué
        if(isset($login)){
            $this->load->helper('url');
            redirect("/mes_cours");
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
                    redirect("/mes_cours");
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
}