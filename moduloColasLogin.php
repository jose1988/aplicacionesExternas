<?php
session_start();
include("/recursos/funciones.php");
if(existeSesion()){
	iraURL("moduloColasVisualizar.php");
}
if (isset($_POST["Biniciar"])) {
  require_once('nusoap.php'); 
  $wsdl_url = 'http://localhost:15362/HoriFarmacia/WS_mari?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $Analista= array('idanalista' => '1','nombre' => $_POST["usuario"],'usuario' => $_POST["usuario"],'contrasena'=>$_POST["password"]);
  $Parametros= array('Analistaa' => $Analista);
  $resultadoLogIn = $client->logIn($Parametros);
  //echo '<pre>';
//  print_r($resultadoLogIn);
  if($resultadoLogIn->return==1){
		$Usuario= array('Usuario' => $_POST["usuario"]);	
		$resultadoAnalista = $client->obtenerAnalistaXUsuario($Usuario);
		if($resultadoAnalista!=null){
		//echo '<pre>';
	//	print_r($resultadoAnalista);
			$_SESSION["Analista"]=$resultadoAnalista;
			iraURL("moduloColasVisualizar.php");
		}else{
		javaalert( "no hay conexión");
		}		
  }else{
  		javaalert("No coinciden el usuario y contraseña ,por favor verifique");
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Seguros Horizonte | HorizonLine</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- javascript -->
	<script type='text/javascript' src="js/jquery-1.9.1.js"></script>
	<script type='text/javascript' src="js/bootstrap.js"></script>
	<script type='text/javascript' src="js/bootstrap-transition.js"></script>
	<script type='text/javascript' src="js/bootstrap-tooltip.js"></script>
	<script type='text/javascript' src="js/modernizr.min.js"></script>
<!--<script type='text/javascript' src="js/togglesidebar.js"></script>-->	
	<script type='text/javascript' src="js/custom.js"></script>
	<script type='text/javascript' src="js/jquery.fancybox.pack.js"></script>

	
	<!-- styles -->
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/jquery.fancybox.css" rel="stylesheet">
    <link href="css/estiloLogin.css" rel="stylesheet">
	<!-- [if IE 7]>
	  <link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
	<![endif]--> 
	
	<!--Load fontAwesome css-->
	<link rel="stylesheet" type="text/css" media="all" href="font-awesome/css/font-awesome.min.css">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    
	<!-- [if IE 7]>
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome-ie7.min.css">
	<![endif]-->

</head>

   
<body class="appBg">

	<div id="header">
		<div class="container header-top-top hidden-phone">
			<img alt="" src="../HorizonLine - Farmacia/images/header-top-top-left.png" class="pull-left">
			<img alt="" src="../HorizonLine - Farmacia/images/header-top-top-right.png" class="pull-right">
		</div>
		<div class="header-top">
			<div class="container">
				<img alt="" src="../HorizonLine - Farmacia/images/header-top-left.png" class="pull-left">
				<div class="pull-right">
					
				</div>
			</div>
			<div class="filter-area">
				<div class="container">
					
					<span lang="es">&nbsp;</span></div>
			</div>
		</div>
	</div>

	<div id="middle">
	
	  <div class="container app-container">
			 
			 
	    <div>
			 	<ul class="nav nav-pills">
			 		<li class="pull-left">
			 			<div class="modal-header">
							<h3>Horizon<span>Line</span> - Farmacia</h3>
						</div>
					</li>
			 		
			 	</ul>
		   </div>
           
		<!--Caso pantalla uno-->
       <div class="tab-content">
       
       	  <div id="logueo" align="center">
     		<form class="form-signin" method="post">
        		<h3 class="form-signin-heading">Por favor, inicie sesión</h3>
        		<input type="text" class="input-block-level" placeholder="Usuario" name="usuario" id="usuario" maxlength="34"  title="Solo se admite minusculas y puntos" autofocus required>
        		<input type="password" class="input-block-level" placeholder="Contraseña" name="password" id="password" maxlength="34" pattern="[A-Za-z.0-9ñÑ]{1,34}" required>
        		<button class="btn btn-large btn-info" type="submit" name="Biniciar">Iniciar Sesión</button>
      		</form>

    	</div>
    
	</div>
	
    <!-- /container -->
	<div id="footer" class="container">    	
	</div>

    
 </div>

    </body>
</html>
