<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// function loadViewHome($view, $title, $subtitle, $jsFiles = '', $cssFiles = '', $data = array(''), $meta = array()) {
//     $CI =& get_instance();

//     $menu = listMenuItens(true);

//     $menuTemplate = $CI->load->view("templates/menu", array('menu' => $menu), true);
//     $header = $CI->load->view("templates/header_home", array('title' => $title, 'subtitle' => $subtitle, 'menu' => $menu), true);
//     $content = $CI->load->view("content/base_view", array('data' => $data), true);
//     $footer = $CI->load->view("templates/footer_home", array(), true);
//     $js = loadJS($jsFiles);
//     $css = loadCSS($cssFiles);

//     $data = array(
//         'header'    => $header,
//         'content'   => $content,
//         'footer'    => $footer,
//         'menu'      => $menuTemplate,
//         'js'        => $js,
//         'css'       => $css,
//         'meta'      => loadMetaTag($meta)
//     );

//     $CI->parser->parse($view, $data);
// }


function loadView($template, $view = '', $page, $menuModel = 'menu', $footer = 'footer', $lateral = '', $header = '', $jsFiles = '', $cssFiles = '', $params = array(), $meta = array()) {
    $CI =& get_instance();

    $menu = false;

    $menuTemplate = '';
    if($menuModel!='') $menuTemplate = $CI->load->view("templates/".$menuModel, array('menu' => $menu, 'params' => $params), true);
    if($header!='') $header = $CI->load->view("templates/header_" . $header, array(), true);
    $content = $CI->load->view("content/" . $view . "_view", array('page' => $page, 'params' => $params), true);

    if($footer!='') {$footer = $CI->load->view("templates/" . $footer, array(), true);}
    else{$footer = $CI->load->view("templates/footer", array(), true);}
    
    //lateral admin
    if($lateral != ''){$lateral = $CI->load->view("templates/" . $lateral, array(), true);}

    $js = loadJS($jsFiles);
    $css = loadCSS($cssFiles);

    $data = array(
        'header'    => $header,
        'content'   => $content,
        'footer'    => $footer,
        'lateral'   => $lateral,
        'menu'      => $menuTemplate,
        'params'    => $params,
        'js'        => $js,
        'css'       => $css,
        'meta'      => loadMetaTag($meta)
    );
    $CI->parser->parse($template, $data);
}

function loadAdminView($template, $view = 'default', $page = '', $params = array()) {
    $CI =& get_instance();
    $content = '';

    if(!isLogged() || (!$CI->session->is_admin || $CI->session->is_admin==false || !isset($CI->session->is_admin))) redirect(base_url('online'), 'location');

    if($view=='') $view = 'default';
    $content = $CI->load->view("admin/" . $view . "_view", array('page' => $page, 'params' => $params), true);

    $data = array(
        'content'   => $content,
        'params'    => $params
    );

    $CI->parser->parse('admin/'.$template, $data);
}

define("JS_VERSION", "5.3");
define("CSS_VERSION", "5.3");

function loadJS($jsFiles) {
    return '';
    // if($jsFiles == '') return '<script src="assets/main.js?v='.JS_VERSION.'"></script><script>verify_top_header(true);</script>';
    // else if($jsFiles == 'online_assistir') return '<script src="assets/main.js?v='.JS_VERSION.'"></script><script src="assets/js/online_assistir.js"></script>';
    // else if($jsFiles == 'online_dash') return '<script src="assets/main.js?v='.JS_VERSION.'"></script><script src="assets/js/online_dash.js"></script>';
    // else if($jsFiles == 'base') return '<script src="assets/main.js?v='.JS_VERSION.'"></script><script src="assets/js/jquery.circular-carousel.js"></script><script src="assets/resultsGulp/js/home.js?v='.CSS_VERSION.'"></script>';
}

function loadCSS($cssFiles = '') {
    return '';
    // if($cssFiles == '') return '<link rel="stylesheet" type="text/css" href="assets/main.css?v='.CSS_VERSION.'">';
    // if($cssFiles == 'base') return '<link rel="stylesheet" type="text/css" href="assets/main.css?v='.CSS_VERSION.'"><link rel="stylesheet" type="text/css" href="assets/resultsGulp/css/home.css?v='.CSS_VERSION.'">';
}


function loadMetaTag($MetaTagArray = array()){
    $CI =& get_instance();
    $meta = array();
    $meta['type']           = 'website';
    $meta['title']          = 'Análise de Dados';
    $meta['description']    = '';
    $meta['url']            = base_url().$CI->uri->uri_string();
    $meta['published_time'] = date("Y-m-d");
    $meta['locale']         = 'pt-BR';    

    foreach($MetaTagArray as $key => $value) $meta[$key] = $value;
    return '<title>'.$meta['title'].'</title>
	<link rel="canonical" href="'.$meta['url'].'">
	<meta http-equiv="content-language" content="'.$meta['locale'].'" />
	<meta name="description" content="'.$meta['description'].'" />
	<meta property="og:type" content="'.$meta['type'].'" />
	<meta property="og:locale" content="'.$meta['locale'].'" />
	<meta property="og:title" content="'.$meta['title'].'" />
	<meta property="og:url" content="'.$meta['url'].'"  />
	<meta property="og:site_name" content="'.$meta['title'].'" />
	<meta property="og:description" content="'.$meta['description'].'" />';
}