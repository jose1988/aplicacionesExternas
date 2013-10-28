<?php 
  require_once('nusoap.php'); 
  $wsdl_url = 'http://localhost:15362/HoriFarmacia/Joseweb?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $Analista= array('idAnalista' => '1');
  $Resultado = $client->listaPreordenMedicamentoAnalistaXidAnalista($Analista);
 $i=0;
  foreach ($Resultado->return as $r) {
	  $i++;
  }
  echo '__________';
 //print_r($Resultado->return);
  print_r(count($Resultado->return));
  $reg=count($Resultado->return);
 echo '__________°°°°°°°°°°°°°°°°°°°°°°°°°°°°______________';
 $Resultad2 = $client->promedioSolicitudesXidAnalista($Analista);
  $pro=count($Resultado2->return);

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
	<link href="css/bootstrap-combined.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/jquery.fancybox.css" rel="stylesheet">
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
			<img alt="" src="images/header-top-top-left.png" class="pull-left">
			<img alt="" src="images/header-top-top-right.png" class="pull-right">
		</div>
		<div class="header-top">
			<div class="container">
				<img alt="" src="images/header-top-left.png" class="pull-left">
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
			 
	<!--Caso-->
			             
              <div class="tab-content">
                  <div class="span10">
                        <button type="button" class="btn btn-success">Regresar</button>
                  </div>
                        
                  <div class="span10"> 
                  <br>
                         <table border="0">
                           
                              <tbody>
                                <tr>
                                  <th align="left"> Nombre de Operador:</th>
                                  <td align="right">Jhon</td>
                                </tr>
                             
                                <tr>
                                  <th align="left">Solicitudes procesadas hoy:</th>
                                  <td align="right"><?php echo $reg?></td>
                                </tr>
                             
                                <tr>
                                  <th align="left">Promedio de Solicitudes atendidas:</th>
                                  <td align="right"><?php echo $pro?></td>
                                </tr>
                             
                                <tr>
                                  <th align="left">Operadores Conectados</th>
                                  <td align="right">5</td>
                                </tr>
                              </tbody>
                            </table>
                            
                  </div>
                  
                 <div class="span6"> 
                  <br>
                
                         <table class="table table-striped table-bordered" align="center">
                              <thead bgcolor="#B9B9B9">
								 <tr>
								   <th style="width:9%">Nro de Preorden</th>
                                   <th style="width:7%">Fecha Hora</th>
                                   <th style="width:7%">Aprobacion</th>
                                   <th style="width:7%">Auditar</th>
								 </tr>
							  </thead>
                              <tbody>
                                <tr>
                                <?php
								  $j=0;
								     while($j<$reg){ ?>
               <td align="center">    <?php echo $Resultado->return[0]->preordMedId->idpreorden->idpreorden ?></td>
                                  <td align="center">  <?php echo $Resultado->return[0]->fecha ?></td>
                                  <td align="center"><?php echo $Resultado->return[0]->preordMedId->idpreorden->aprobado ?></td>
                                   <td align="center"><button type="button" class="btn btn-success"><i class="icon-check"></i></button></td>
                                </tr>
                           
                               <?php $j++; } ?>
                                 
                              </tbody>
                            </table>
                            
                  </div>
                  
              </div>
     
		
		</div><!-- /container -->

	<div id="footer" class="container">
	</div>
    </div>
    
    
    
    <script><!-- Ocultar segunda patologia y mostrarla (solo para demostración)-->
    	$(".2da").hide();
    	$("button.siguiente-patologia").click(function() {
		  $(".2da").show();
		});
    </script>
    	
    <script> /*mostrar select de razon de rechazo de medicamento*/
   		$(".btn-danger").click(function(){
		  $(this).closest('div').find(".reason").removeClass("ocultar");
		});
    </script>
    
    
    <script> /*activa el funcionamiento del fancybox para ver los documentos adjuntos*/
		$(document).ready(function() {
			$(".fancybox").fancybox();
		});
	</script>
    	

    </body>
</html>
