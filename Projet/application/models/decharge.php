<?php

	class decharge extends CI_Model{

		function __construct()
	    {
	        parent::__construct();
	    }

	    //----------SELECT----------
	 	function selectDechargeLogin($login){
			$sql = "SELECT * FROM decharge WHERE enseignant = '$login'";
			return $this->db->query($sql)->result_array();
		}

    


	}
?>
