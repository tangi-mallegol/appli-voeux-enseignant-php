<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mes_cours extends CI_Controller {

	public function index()
	{
        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        if(!isset($login)){
            $this->load->helper('url');
            redirect("/welcome");
        }
        $array["admin"] =  $_SESSION["admin"];
        $login = $_SESSION["login"];
        $this->load->model("contenu");
        $array["cours"] =  $this->contenu->selectCours($login);
        $array["TP"] =  $this->contenu->selectTP($login);
        $array["TD"] =  $this->contenu->selectTD($login);
        $array["CM"] =  $this->contenu->selectCM($login);
        $this->load->helper(array('form'));
        $this->load->view('mes_cours.php',$array);
	}
}