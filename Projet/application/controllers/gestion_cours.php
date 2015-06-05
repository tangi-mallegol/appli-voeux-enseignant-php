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
            $array["admin"] = $_SESSION["admin"];
            $this->load->helper(array('form'));
            $this->load->view('profil.php',$array);
        }
        else{
            $this->load->helper('url');
            redirect("/home");
        }
	}
}