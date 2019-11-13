<?php

class base_model extends CI_Model {


    public function __construct(){
        parent::__construct(); 
		$this->load->database(); 
    }
    
    private function relpace_data($dados, $hora){ 
		$data = explode("/", $dados);
		return $data[2] . "-" . $data[1] . "-" . $data[0] . " ".$hora;
    } 
    
   public function migracao(){
        $dados = array();
   
		foreach($dados as $key){  
			$array = array( 
				"Temperatura" =>  $key[1],
				"Temperatura_2" =>  $key[2],
				"Umidade" => $key[0],
				"Data" => $this->relpace_data($key[3], $key[4]), 
				"anemometro" => $key[5],
				"idLocal" => $key[6]
			);
			$this->db->insert('dados',$array);
        }
        
        return true;
    }


	public function apagar_dados($id){
		$this->db->query("DELETE FROM `dados` WHERE `idLocal` = ".$id);
		if($this->db->query("DELETE FROM `local` WHERE `local`.`idLocal` = ".$id)){
			return array("status" =>"sucess");	
		}else{
			return array("status" =>"error");
		}
	}

    public function pega_dados(){
		$arr = $this->db->get("local")->result_array();
		if(count($arr) > 0){
			return $this->db->get_where('dados', array("idLocal"=>$arr[0]["idLocal"]))->result_array();
		}
		return array();
	}
	

	public function pega_municipio(){
		return $this->db->get('local')->result_array();
	}

	public function upload($dados){
		 
		foreach($dados as $key){  
			$array = array( 
				"Temperatura" =>  $key[1],
				"Temperatura_2" =>  $key[2],
				"Umidade" => $key[0],
				"Data" => $this->relpace_data($key[3], $key[4]), 
				"anemometro" => $key[5],
				"idLocal" => $key[6]
			);
			$this->db->insert('dados',$array);
        }
        
		return array("status" =>"sucess");
		
	}


	public function localizacoes($vars = array()){
		if($this->db->insert('local',$vars)){
			return array("status" =>"sucess");
		}
		else{
			return array("status" =>"error");
		}
	}

	public function filtroTabela($vars=array()){
		$dataIni = $vars["dataIni"];
		$dataFim = $vars["dataFim"];
		$idLocal = $vars["idLocal"];
		if(empty($dataFim)){
			$res = $this->db->query("SELECT * FROM `dados` WHERE `Data` >= '$dataIni' and idLocal=$idLocal")->result_array();
			return json_encode($res);
		}else{
			$res = $this->db->query("SELECT * FROM `dados` WHERE `Data` >= '$dataIni' AND `Data` <= '$dataFim' ")->result_array();
			return json_encode($res);
		}
	 
	}
}