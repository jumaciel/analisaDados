<?
ini_set('display_errors',0);
ini_set('display_startup_erros',01);
error_reporting(0);  
?>
<!DOCTYPE HTML>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    {css}
    {meta}
    <link rel="icon" type="image/png" sizes="16x16" href="assets/plugins/images/lupagrafico.png">
    <title>Sistema para analise de dados</title> 
    <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet"> 
    <link href="assets/css/animate.css" rel="stylesheet"> 
    <link href="assets/css/style.css" rel="stylesheet"> 
    <link href="assets/css/colors/default.css" id="theme" rel="stylesheet">
   
</head>

<body class="fix-header">
<div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="analisaDados.html">

                            <!-- Logo icon image, you can use font-icon also --><b>
                         
                            <!--This is light logo icon--><img src="assets/plugins/images/Logotipo_IFET.png" height="35" alt="home"
                                class="light-logo" />
                        </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                     
                            <!--This is light logo text--><img src="assets/plugins/images/logoifcortada.png" height="35" alt="home"
                                class="light-logo" />
                        </span> </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg"
                            href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    </li>
                
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
    {menu}
    <!-- Page Contents -->
    <div class="pusher">
      {header}
      <!-- PAGE CONTENT -->
          <!-- Side Navbar -->
      <div class="content-wrap">
        <div class="page">
            <div class="page-content d-flex align-items-stretch"> 
                {lateral}
                {content}
            </div>
        </div>
      </div> 
    </div> 
    {js}    
    {footer}
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="assets/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="assets/js/custom.min.js"></script>
  </body>
  
</html>
 