<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends CI_Controller {

	public function index()
	{
        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        if(!isset($login)){
            $this->load->helper('url');
            redirect("/welcome");
        }
        else if($_SESSION["admin"] = true){
            $array["admin"] =  $_SESSION["admin"];
            //Content
            $this->load->helper(array('form'));
            $this->load->view('modules.php',$array);
        }
        else{
            $this->load->helper('url');
            redirect("/home");
        }
	}
}