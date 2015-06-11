<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gestion_cours extends MY_MainController {

	public function index($erreur = null)
	{
        $this->filter_access(true);
        $array["admin"] = $_SESSION["admin"];
        $this->load->helper(array('form'));
        $this->load->view('profil.php',$array);
	}
}