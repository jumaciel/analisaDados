<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
  
	public function __construct(){
        parent::__construct();
		$this->load->model('base_model'); 
    }
    
	public function index()
	{  
        loadView('base', 'home', '', 'menu', '', '', '', '', array("params" => $this->pega_dados()), array("dados" => $this->pega_dados(), "municipio" => $this->pega_municipio() ));
    }
    
    public function analisaDados()
	{ 
        loadView('base', 'home', '', 'menu', '', '', '', '', array("params" => $this->pega_dados()), array("dados" => $this->pega_dados(), "municipio" => $this->pega_municipio() ));
    }
     
    public function cadastraBase()
	{ 
        loadView('base', 'cadastraBase', '', 'menu', '', '', '', '', array(), array("title"=>"AnalisaDados"));
    }
    
    public function informacoes()
	{ 
        loadView('base', 'informacoes', '', 'menu', '', '', '', '', array(), array("title"=>"AnalisaDados"));
    }
    public function insereDados()
	{ 
        loadView('base', 'insereDados', '', 'menu', '', '', '', '', array("title"=>"AnalisaDados"), array( "municipio" => $this->pega_municipio()));
    }
    public function tabela()
	{ 
        loadView('base', 'tabela', '', 'menu', '', '', '', '', array(),  array("dados" => $this->pega_dados(), "municipio" => $this->pega_municipio() ));
    }
    public function localizacao()
	{ 
        loadView('base', 'localizacao', '', 'menu', '', '', '', '',  array(),  array("dados" => $this->pega_dados(), "municipio" => $this->pega_municipio() ));
    }
      

    public function apagar_dados(){
      return $this->base_model->apagar_dados($this->input->get("idLocal"));
    }
    private function pega_dados(){
	    return $this->base_model->pega_dados();
    }
    private function pega_municipio(){
		return $this->base_model->pega_municipio();
    }
    
    public function localizacoes(){
		  return $this->base_model->localizacoes($this->input->post());
    }
    public function upload(){  
        
      $dados = array();
      if ($file = fopen($_FILES["log"]["tmp_name"], "r")) {
        while(!feof($file)) {
          $line = fgets($file); 
                $arr = explode("~#~", $line);
                $arr[6] = $this->input->post("idLocal");
          if($arr[0] != null){
            array_push($dados, $arr);
          } 
        }
        fclose($file);
        }
    
      echo json_encode($this->base_model->upload($dados));
    }
    public function filtroTabela(){
		  print $this->base_model->filtroTabela($this->input->post());
    }
    
    public function migracao(){ 
		if($this->base_model->migracao()){ 
      loadView('base', 'migrar_dados', '', 'menu', '', '', '', '', $this->pega_dados(), array("title"=>"Analisa Dados"));
		}
	}
}