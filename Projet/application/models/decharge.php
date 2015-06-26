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

    	function addDecharge($login,$nb_heure){
    		$sql = "SELECT * FROM decharge WHERE enseignant = '$login'";
    		$result = $this->db->query($sql)->result_array();
    		if(count($result) == 0){
    			$sql = "INSERT INTO decharge VALUES ('$login', $nb_heure)";
    			$result = $this->db->query($sql);
    			if(!result)
 					return array("erreur" => true, "message" => "Erreur lors de l'ajout de la decharge.");
    		}else{
    			if($nb_heure == 0){
    				$sql = "DELETE FROM decharge WHERE enseignant = '$login'";
	    			$result = $this->db->query($sql);
	    			if(!result)
	 					return array("erreur" => true, "message" => "Erreur lors de la suppression de la decharge.");
    			}else{
    				$sql = "UPDATE decharge SET decharge = $nb_heure WHERE enseignant = '$login'";
	    			$result = $this->db->query($sql);
	    			if(!result)
	 					return array("erreur" => true, "message" => "Erreur lors de l'edition de la decharge.");
    			}
				
    		}
    	}


	}
?>
