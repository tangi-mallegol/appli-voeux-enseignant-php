<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends MY_MainController {

	public function index()
	{
        $this->filter_access(true);
        $array["admin"] =  $_SESSION["admin"];
        //Content
        $this->load->helper(array('form'));
        $this->load->view('modules.php',$array);
	}
}