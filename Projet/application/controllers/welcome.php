<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index($erreur = null)
	{
        $login = isset($_SESSION["login"]) ? $_SESSION["login"] : null;
        if(isset($login)){
            $this->load_controller("home","index");
        }
        $this->load->helper(array('form'));
		$this->load->view('welcome_message');
	}

    public function login(){
        $login = isset($_POST["login"]) ? $_POST["login"] : null;
        $password = isset($_POST["password"]) ? $_POST["password"] : null;
        if($login != null && $login == "tangi.mallegol@gmail.com"){
            if($password != null && $password == "test"){
                $_SESSION["login"] = $login;
                $_SESSION["admin"] = true;
                $this->load_controller("home","index");
            }
            else $this->index();
        }
        else $this->index();
    }

    function load_controller($controller, $method = 'index')
    {
        require_once(FCPATH . APPPATH . 'controllers/' . $controller . '.php');
        $controller = new $controller();
        return $controller->$method();
    }
}