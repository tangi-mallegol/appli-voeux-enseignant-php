<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends MY_MainController {

    public function index(){
        $this->filter_access();
		$array["login"] = $_SESSION["login"];
        $array["admin"] = $_SESSION["admin"];
        $this->load->helper(array('form'));
        $this->load->view('home.php',$array);
    }

    public function deconnexion(){
    	session_destroy();
    	$this->load->helper('url');
        redirect("/welcome");
    }
}