<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function index($erreur = null)
	{
        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        /*if(!isset($login)){
            $this->load->helper('url');
            redirect("/welcome");
        }*/
        $this->load->model("contenu");
        $array["contenu"] =  $this->contenu->selectCours($login);
        $this->load->helper(array('form'));
        $this->load->view('profil.php',$array);
	}
}