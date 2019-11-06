<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home'; 

//rotas:

$route['analisaDados'] = 'home/analisaDados'; 
$route['cadastraBase'] = 'home/cadastraBase';  
$route['informacoes'] = 'home/informacoes';  
$route['insereDados'] = 'home/insereDados'; 
$route['tabela'] = 'home/tabela'; 
$route['localizacao'] = 'home/localizacao'; 
$route['migracao'] = 'home/migracao'; 
 

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
