<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

    public function index(){
    	$array["login"] = $_SESSION["login"];
        $this->load->helper(array('form'));
        $this->load->view('home.php',$array);
    }
}