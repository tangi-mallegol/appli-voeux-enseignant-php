<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enseignant extends CI_Controller {

	public function index($erreur = null)
	{
        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        if(!isset($login)){
            $this->load->helper('url');
            redirect("/welcome");
        }
        $enseignant = $this->uri->segment(2);
        $this->load->model("user");
        $array["enseignant"] = $enseignant;
        $array["user"] =  $this->user->selectEnseignant($enseignant);
        $array["admin"] =  $_SESSION["admin"];
        $this->load->model("contenu");
        $array["all"] = $this->contenu->selectCours($enseignant);
        $array["TP"] = $this->contenu->selectTP($enseignant);
        $array["TD"] = $this->contenu->selectTD($enseignant);
        $array["CM"] = $this->contenu->selectCM($enseignant);
        $this->load->helper(array('form'));
        $this->load->view('enseignant.php',$array);
	}
}