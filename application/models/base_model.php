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
		if ($file = fopen(BASEPATH."/../MIGRAR/datalogger.txt", "r")) {
		   while(!feof($file)) {
			   $line = fgets($file); 
			   $arr = explode("~#~", $line);
			   if($arr[0] != null){
				   array_push($dados, $arr);
			   } 
		   }
		   fclose($file);
	   	}
   
		foreach($dados as $key){  
			$array = array( 
				"Temperatura" =>  $key[1],
				"Temperatura_2" =>  $key[2],
				"Umidade" => $key[0],
				"Data" => $this->relpace_data($key[3], $key[4]), 
				"idLocal" => $key[5]
			);
			$this->db->insert('dados',$array);
        }
        
        return true;
    }


    public function pega_dados(){
        return $this->db->get_where('dados', array("idLocal"=>1))->result_array();
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
				"idLocal" => $key[5]
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