<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends MY_MainController {

	public function index($erreur = null)
	{
        $this->load->model("contenu");
        $array["contenu"] =  $this->contenu->selectCours($login);
        $array["admin"] =  $_SESSION["admin"];
        $this->load->helper(array('form'));
        $this->load->view('profil.php',$array);
	}

    function changePassword($login, $password){
        
    }
}