<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends CI_Controller {

	function __construct()
    {
       parent::__construct();
    }

    function load_controller($controller, $method = 'index')
    {
        require_once(FCPATH . APPPATH . 'controllers/' . $controller . '.php');
        $controller = new $controller();
        return $controller->$method();
    }
    
    function filter_access($admin_ = false, $login_ = null){
    	//Si l'utilisateur n'est même pas authentifié
    	$login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
    	$admin = isset($_SESSION["admin"]) ? $_SESSION["admin"] : null;
    	if(!isset($login)){
		    $this->load->helper('url');
		    redirect("/welcome");
		}
    	//Si l'utilisateur doit être admin
    	if($admin = true){
    		if(!(isset($admin_) && $admin_ = true)){
    			$this->load->helper('url');
            	redirect("/home");
    		}
    	}
		//Si l'utilisateur doit porter un $login particulier (exemple de modification de mot de passe d'un $login)
		if(isset($login) && !empty($login)){
			$this->load->helper('url');
        	redirect("/home");
		}
    }
}