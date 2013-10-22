﻿<?php 
  require_once('nusoap.php'); 
  $wsdl_url = 'http://localhost:15362/HoriFarmacia/WS_mari?WSDL';
  $client = new SOAPClient($wsdl_url);
  $client->decode_utf8 = false; 
  $Preorden= array('idPreorden' => '1');	
  $Resultado = $client->obtenerPreordenMedicamentoXIdPreorden($Preorden);
 $i=0;
  foreach ($Resultado->return as $r) {
	  $i++;
  }
//  echo '__________'.$i;
 //print_r(count($Resultado->return));
 // print_r($Resultado->Idmedicamento);//->return[0]->Idmedicamento->Descripcion

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
                   
	                <div id="consultar">
	                	
	                	<div class="datos">
						
							<h1>Datos del Solicitante</h1>
							
							<table class="table table-striped table-bordered">
								<thead>
								    <tr>
								      <th colspan="4">Datos del solicitante</th>
								    </tr>
								  </thead>
								<tbody>
								<tr>
								  <th style="width:7%">Nombre</th>
								  <td><?php echo $Resultado->return[0]->idpreorden->retiranombre ?></td>
								  <th style="width:8%">Apellido</th>
								  <td><?php echo $Resultado->return[0]->idpreorden->retiraapellido ?></td>
								  <th style="width:7%">Póliza</th>
								  <td><?php echo $Resultado->return[0]->idpreorden->idepol ?></td>
								  <th style="width:9%">Certificado</th>
								  <td><?php echo $Resultado->return[0]->idpreorden->numcert ?></td>	
								  <th style="width:8%">Compañia</th>
								  <td>Seguros Horizonte S.A</td>
								</tr>
								
								</tbody>
							</table>
							
							<table class="table table-striped table-bordered">
								<thead>
								    <tr>
								      <th colspan="4">Datos del paciente</th>
								    </tr>
								  </thead>
								<tbody>
								<tr>
								  <th style="width:10%">Nombre</th>
								  <td style="width:20%">Jaimito</td>
								  <th style="width:10%">Apellido</th>
								  <td>Perez</td>
								</tr>
								
								</tbody>
							</table>
							
							<table class="table table-striped table-bordered">
								<thead>
								    <tr>
								      <th colspan="4">Datos médicos</th>
								    </tr>
								  </thead>
								<tbody>
								<tr>
								  <th>Fecha del Informe</th>
								  <td><?php echo $Resultado->return[0]->idpreorden->fechainformemedico ?></td>
								  <th>Descripción</th>
								  <td style="width:60%"><?php echo $Resultado->return[0]->idpreorden->diagnosticomedico ?></td>
								</tr>
								
								</tbody>
							</table>
						
						</div>
						
						
						
						
                        <div class="patologias"> <!--Combo de patologia con medicamentos-->
							
							<h2>Patología</h2>
							
							<select class="input-xxlarge inline" disabled>>
								<option>Cefalea</option>
								<option>Hipertensión Arterial</option>
								<option>Gastritis</option>
							</select>
							
							 
								<!-- Modal -->
								<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								  <div class="modal-header">
								    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								    <h3 id="myModalLabel">Agregar Patología</h3>
								  </div>
								  <div class="modal-body">
								        <input type="text">
								  </div>
								  <div class="modal-footer">
								    <button type="submit" data-dismiss="modal" class="btn btn-primary">Guardar</button>
								  </div>
								</div>
							
							<div class="medicamentos">
						
							<h3>Medicamentos</h3>
							<?php 
						for($i=0;$i<count($Resultado->return);$i++){
						?>	
							<div class="drug-process">
								<div class="input-prepend">
									<label>Medicamento</label>
									<select disabled>
									  <option><?php echo $Resultado->return[$i]->idmedicamento->descripcion ?></option>
									  <option>PANTOPRAZOL SG TAB 40MG X 7</option>
									  <option>ATAMEL TAB 500MGX10</option>
									</select>
								</div>
								<div class="input-append">
									<label>Dosis</label>
									<select disabled>
										<option><?php echo $Resultado->return[$i]->iddosis->nombre ?></option>
										<option>BID- 2 veces al dia- Cada 12 horas</option>
										<option>TID- 3 veces al dia- Cada 8 horas</option>
										<option>QID- 4 veces al dia- Cada 6 horas</option>
										<option>STA- Orden Inmediata</option>
										<option>SOS- Solo en caso de presentar patologia</option>
										<option>ID-Interdiaria</option>
										<option>Dosis unica</option>
									</select>
								</div>
								<div class="input-append">
									<label>Días</label>
									<input class="input-mini" type="text" value="<?php echo $Resultado->return[$i]->duracion ?>" disabled>
								</div>
								<div class="input-append">
									<label>Frascos</label>
									<input class="input-mini" type="text" value="<?php echo $Resultado->return[$i]->cantidad ?>" disabled>
								</div>
								<div class="input-append">
									<label>Precio</label>
									<input class="input-mini" type="text" value="50" disabled>
								</div>
								<div class="input-append">
									<label>Subtotal</label>
									<input class="input-mini" type="text" value="150" disabled>
								</div>
								<div class="input-append" data-toggle="buttons-radio">
									<label>Aprobación</label>
								<label>Aprobado</label>
									<!--<label class="radio inline"><input type="radio" name="optionsRadios" id="optionsRadios1" value="aprovado"> Aprovado</label>
									<label class="radio inline"><input type="radio" name="optionsRadios" id="optionsRadios2" value="rechazado"> Rechazado</label>-->
								</div>
								<div class="input-append reason">
									<label>Motivo</label>
									<select disabled>>
									  <option>Recaudos incompletos</option>
									  <option>Sin diagnostico relacionado</option>
									  <option>No amparado por el condicionamiento de la póliza</option>
									  <option>tto. de origen natural</option>
									  <option>tto. con i.v.a</option>
									</select>
								</div>
							</div>
							 <?php 
						}
						
						?> 
						<!--	
							<div class="drug-process">
							<div class="input-prepend">
								<label>Medicamento</label>
								<select disabled>
								  <option>PANTOPRAZOL SG TAB 40MG X 7</option>
								  <option>Teragrip</option>
								  <option>ATAMEL TAB 500MGX10</option>
								</select>
							</div>
							<div class="input-append">
								<label>Dosis</label>
								<select disabled>
								    <option>OD-Orden diaria-cada 24 horas</option>
									<option>BID- 2 veces al dia- Cada 12 horas</option>
									<option>TID- 3 veces al dia- Cada 8 horas</option>
									<option>QID- 4 veces al dia- Cada 6 horas</option>
									<option>STA- Orden Inmediata</option>
									<option>SOS- Solo en caso de presentar patologia</option>
									<option>ID-Interdiaria</option>
									<option>Dosis unica</option>
								</select>
							</div>
							<div class="input-append">
								<label>Días</label>
								<input class="input-mini" type="text" value="3" disabled>
							</div>
							<div class="input-append">
								<label>Frascos</label>
								<input class="input-mini" type="text" value="5" disabled>
							</div>
							<div class="input-append">
								<label>Precio</label>
								<input class="input-mini" type="text" value="50" disabled>
							</div>
							<div class="input-append">
								<label>Subtotal</label>
								<input class="input-mini" type="text" value="150" disabled>
							</div>
							<div class="input-append" data-toggle="buttons-radio">
								<label>Aprobación</label>
								<label>Rechazado</label>

							</div>
							<div class="input-append reason">
								<label>Motivo</label>
								<select disabled>
								  <option>Recaudos incompletos</option>
								  <option>Sin diagnostico relacionado</option>
								  <option>No amparado por el condicionamiento de la póliza</option>
								  <option>tto. de origen natural</option>
								  <option>tto. con i.v.a</option>
								</select>
							</div>
						</div>
						
						</div>
							
						<div class="row-fluid limite-monto">
							<div class="span4">
								<span class="limite">Límite para la Patología</span>
								<span><input class="span4" id="prependedInput" type="text" placeholder="20000" disabled></span>
							</div>	
							<div class="span4 text-right">
								<div class="input-prepend">
									<span class="add-on">Total Bs.</span>
									<input class="span4" id="prependedInput" type="text" placeholder="2500" disabled>
								</div>
							</div>
						</div>
							-->
					</div>
                        
                      
						
						
						
						
						<!--Segunda patología con su medicamento-->
						
						
						<div class="patologias 2da"> 
							
							<h2>Patología</h2>
							
							<select class="input-xxlarge inline">
								<option>Hipertensión Arterial</option>
								<option>Cefalea</option>
								<option>Gastritis</option>
							</select>
							
							<div class="medicamentos">
						
							<h3>Medicamentos</h3>
							
						
							<div class="drug-process">
								<div class="input-prepend">
									<label>Medicamento</label>
									<select disabled>
									  <option>ATAMEL TAB 500MGX10</option>
									  <option>Teragrip</option>
									  <option>PANTOPRAZOL SG TAB 40MG X 7</option>
									  
									</select>
								</div>
								<div class="input-append">
									<label>Dosis</label>
									<select disabled>
									    <option>OD-Orden diaria-cada 24 horas</option>
										<option>BID- 2 veces al dia- Cada 12 horas</option>
										<option>TID- 3 veces al dia- Cada 8 horas</option>
										<option>QID- 4 veces al dia- Cada 6 horas</option>
										<option>STA- Orden Inmediata</option>
										<option>SOS- Solo en caso de presentar patologia</option>
										<option>ID-Interdiaria</option>
										<option>Dosis unica</option>
									</select>
								</div>
								<div class="input-append">
									<label>Días</label>
									<input class="input-mini" type="text" value="3">
								</div>
								<div class="input-append">
									<label>Frascos</label>
									<input class="input-mini" type="text" value="5">
								</div>
								<div class="input-append">
									<label>Precio</label>
									<input class="input-mini" type="text" value="50" disabled>
								</div>
								<div class="input-append">
									<label>Subtotal</label>
									<input class="input-mini" type="text" value="150" disabled>
								</div>
								<div class="input-append" data-toggle="buttons-radio">
									<label>Aprobación</label>
									<label>Aprobado</label>
									<!--<label class="radio inline"><input type="radio" name="optionsRadios" id="optionsRadios1" value="aprovado"> Aprovado</label>
									<label class="radio inline"><input type="radio" name="optionsRadios" id="optionsRadios2" value="rechazado"> Rechazado</label>-->
								</div>
								<div class="input-append reason">
									<label>Motivo</label>
									<select disabled>
										<option>Recaudos incompletos</option>
										<option>Sin diagnostico relacionado</option>
										<option>No amparado por el condicionamiento de la póliza</option>
										<option>tto. de origen natural</option>
										<option>tto. con i.v.a</option>
									</select>
								</div>
							</div>
						
						
						</div>
						
						

						<div class="row-fluid limite-monto">
							<div class="span4">
								<span class="limite">Límite para la Patología</span>
								<span><input class="span4" id="prependedInput" type="text" placeholder="20000" disabled></span>
							</div>	
							<div class="span4 text-right">
								<div class="input-prepend">
									<span class="add-on">Total Bs.</span>
									<input class="span4" id="prependedInput" type="text" placeholder="2500" disabled>
								</div>
							</div>
						</div>
	
						</div>
						
						<!--Botón para agregar procesar nueva patología-->
						
						<div class="agregar-patologia">
						
							<button type="button" class="btn siguiente-patologia"><i class="icon-plus-sign"></i> Agregar Patología</button>
						
						</div>
						
						
						<!--Procesar Caso-->
						
						<div class="procesar row-fluid">
							
							<div class="span10">
				             <div class="well">
                                  ...
                                </div>
				            </div>
							<div class="span2">					
								<button type="button" class="btn btn-success">Procesar</button>
							</div>
						</div>	

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
