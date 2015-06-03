<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

    public function index(){
    	if(isset($_SESSION["login"])){
			$array["login"] = $_SESSION["login"];
	        $this->load->helper(array('form'));
	        $this->load->view('home.php',$array);
    	}
    	else{
    		$this->load->helper('url');
            redirect("/welcome");
    	}
    }

    public function deconnexion(){
    	session_destroy();
    	$this->load->helper('url');
        redirect("/welcome");
    }
}