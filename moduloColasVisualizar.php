<?php
  	$wsdl_url = 'http://localhost:15362/HoriFarmacia/ColasWS?WSDL';
	$client = new SOAPClient($wsdl_url);
    $client->decode_utf8 = false;
	
	//Total de Solicitudes por Procesar
	$ResultadoTotalSolicitudes = $client->obtenerColaPreOrden();
	
	//Total de Solicitudes Ingresadas en Cola Hoy
	$ResultadoColaHoy = $client->obtenerTotalXFechaHoy();
	
	
	//Operadores Conectados por Estado (Al cual le asigne '1' si esta conectado)
	$estadoOpeCon= array('estado' =>'1');
    $ResultadoOperadoresConectados = $client->obtenerTotalOperadoresConectadosXEstado($estadoOpeCon);
	
	//Operadores Conectados con las Solicitudes que han Procesados (Al cual le asigne '1' si esta procesada)
	$estadoAnaSolPro= array('estado' =>'1');
    $ResultadoSolicitudesProcesadasXAnalista = $client->listaSolicitudesProcesadasXFecha($estadoAnaSolPro);
	
	//Cantidad de Solicitudes Procesadas por Estado (Al cual le asigne '1' si esta procesada)
	$estadoSolPro= array('estado' =>'1');
    $ResultadoSolicitudesProcesadas = $client->obtenerSolicitudesProcesadasXFecha($estadoSolPro);
    

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
    <script type="text/javascript" src="js/jquery-2.0.2.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>
	
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
    
    <!-- styles de paginacion -->
   	<link href="footable/css/footable-0.1.css" rel="stylesheet" type="text/css" />
	<link href="footable/css/footable.sortable-0.1.css" rel="stylesheet" type="text/css" />
	<link href="footable/css/footable.paginate.css" rel="stylesheet" type="text/css" />
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
           
		<!--Caso pantalla uno-->
       <div class="tab-content">
       </br>
       </br>
       <h1>Datos de las Solicitudes</h1>
       <div class="span10">
       		<div class="span5"> 
       		<br>
            	<table border="0">
                	<tbody>
                    	<tr>
                        	<th align="left">Solicitudes Pendientes por Procesar: </th>
                            <td align="right"><?php echo $ResultadoTotalSolicitudes->return-$ResultadoColaHoy->return ?></td>
                        </tr>
                        <tr>
                            <th align="left">Solicitudes Ingresadas en Cola Hoy: </th>
                            <td align="right"><?php echo $ResultadoColaHoy->return ?></td>
						</tr>
                        <tr>
                        	<th align="left">Total de Solicitudes por Procesar: </th>
                            <td align="right"><?php echo $ResultadoTotalSolicitudes->return ?></td>
                        </tr>
                        <tr>
                        	<th align="left">Operadores Conectados: </th>
                            <td align="right"><?php echo $ResultadoOperadoresConectados->return ?></td>
                		</tr>
                        <tr>
                        	<th align="left">Solicitudes Procesadas: </th>
                            <td align="right"><?php echo $ResultadoSolicitudesProcesadas->return ?></td>
                		</tr>
				</tbody>
          </table>
          </div>
          
          	<div class="span4">
       			<div id="containerDos" style="min-width: 100px; height: 200px; margin: 0 auto">
        		</div>
       		</div>
          
        </div>
       
       <div class="span10">
 
            
        <div class="span5">
       		</br>
       		</br>
        <?php 
			//Verificando que no este vacio o no sea null
			if(isset($ResultadoSolicitudesProcesadasXAnalista->return)){
		?>
       
       		<table class="footable table table-striped table-bordered" align="center" data-page-size="4">
        		<thead bgcolor="#B9B9B9">
        			<tr>
            			<th style="text-align:center" data-sort-ignore="true">Operador</th>
                		<th style="text-align:center" data-sort-ignore="true">Solicitudes Procesadas</th>
                		<th style="text-align:center" data-sort-ignore="true">Visualizar</th>
           		 	</tr>
        		</thead>                
        		<tbody>
                <?php
				
				//Verificando si el resultado es una lista de objetos o un solo un objeto para la lectura de los datos 
				if(count($ResultadoSolicitudesProcesadasXAnalista->return)>1){
				
					for($i=0;$i<count($ResultadoSolicitudesProcesadasXAnalista->return);$i++){
						
						?>
        			<tr>
            			<td style="text-align:center"><?php echo $ResultadoSolicitudesProcesadasXAnalista->return[$i]->nombre ?></td>
              			<?php
							//Obtengo el id del analista
							$id=$ResultadoSolicitudesProcesadasXAnalista->return[$i]->idanalista;
							//Lo convierto en array
							$idAnalista=array('idAnalista' => $id);
							//Llamo al servicio que cuenta cuantas solicitudes fueron procesadas por cada analista 
							$ResultadoSolicitudesProcesadasConteo = $client->contarSHXidAnalista($idAnalista);
						?>
                        
                        <td style="text-align:center"><?php echo $ResultadoSolicitudesProcesadasConteo->return ?></td>
                		<td style="text-align:center">
                        	<a href="moduloColasOperador.php?id=<?php echo $id?>">
                            	<i class="icon-eye-open"></i>
                            </a>
                        </td>
            		</tr>
                    <?php
  					}
				}else{
					?>
        			<tr>
            			<td style="text-align:center"><?php echo $ResultadoSolicitudesProcesadasXAnalista->return->nombre ?></td>
              			<?php
							//Obtengo el id del analista
							$id=$ResultadoSolicitudesProcesadasXAnalista->return->idanalista;
							//Lo convierto en array
							$idAnalista=array('idAnalista' => $id);
							//Llamo al servicio que cuenta cuantas solicitudes fueron procesadas por cada analista 
							$ResultadoSolicitudesProcesadasConteo = $client->contarSHXidAnalista($idAnalista);
						?>
                        <td style="text-align:center"><?php echo $ResultadoSolicitudesProcesadasConteo->return ?></td>
                		<td style="text-align:center">
                        	<a href="moduloColasOperador.php?id=<?php echo $id?>">
                        		<i class="icon-eye-open"></i>
                        	</a>
                        </td>
            		</tr>
                    <?php
					}
					?>
         		</tbody>
        		</table>
                <ul id="pagination" class="footable-nav"><span>Pag:</span></ul>
             <?php
             }
			 //Sino existen registros no muestro la tabla
			 else{?>
				 <div class="alert alert-block" align="center">
   					<h2 style="color:rgb(255,255,255)" align="center">Atención</h2>
    				<h4 align="center">No se han Procesado Solicitudes el Día de Hoy</h4>
   			     </div>
				 <?php }?>
       		</div>
       
       <?php //Verificando que no este vacio o no sea null
			if(isset($ResultadoSolicitudesProcesadasXAnalista->return)){ 
		?>   
            <div class="span4">
            	</br>
       			</br>
       			<div id="containerUno" style="min-width: 100px; height: 200px; margin: 0 auto">
        		</div>
       		</div>
           <?php }?>
       </div>
       	
       </div>
	</div>
    
    <!-- /container -->
	<div id="footer" class="container">    	
	</div>
 </div>
  	
    <script> /*Funciones de los gráfico*/
	$(function () {
		
		/*Gráfico del total de las solicitudes contra las solicitudes procesadas por cada analista*/
        $('#containerUno').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Solicitudes'
            },
			subtitle: {
                text: 'Procesadas por Analista'
            },
            xAxis: {
                categories: [
					<?php 
						if(count($ResultadoSolicitudesProcesadasXAnalista->return)>1){
				
							for($i=0;$i<count($ResultadoSolicitudesProcesadasXAnalista->return);$i++){
								if($i==0){?>
								
								'<?php echo $ResultadoSolicitudesProcesadasXAnalista->return[$i]->nombre; ?>'
								
							<?php }
								else{ ?>
									,'<?php echo $ResultadoSolicitudesProcesadasXAnalista->return[$i]->nombre; ?>'
								<?php }
							}
						}
						else{?>
								'<?php echo $ResultadoSolicitudesProcesadasXAnalista->return->nombre; ?>'
							<?php }
						
					?>
                ]
            },
            yAxis: {
                min: 0,
				max: <?php echo $ResultadoTotalSolicitudes->return ?>,
                title: {
                    text: 'Cantidad Total'
                }
            },
             tooltip: {
                headerFormat: '<span style="font-size:8px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.01,
                    borderWidth: 0
                }
            },
            series: [{				
                name: 'Procesadas por Analista',
                data: [
					<?php 
						if(count($ResultadoSolicitudesProcesadasXAnalista->return)>1){
				
							for($i=0;$i<count($ResultadoSolicitudesProcesadasXAnalista->return);$i++){
								
								//Obtengo el id del analista
								$id=$ResultadoSolicitudesProcesadasXAnalista->return[$i]->idanalista;
								//Lo convierto en array
								$idAnalista=array('idAnalista' => $id);
								//Llamo al servicio que cuenta cuantas solicitudes fueron procesadas por cada analista 
								$ResultadoSolicitudesProcesadasConteo = $client->contarSHXidAnalista($idAnalista);
								
								if($i==0){
									echo $ResultadoSolicitudesProcesadasConteo->return; 
								
								}
								else{ ?>
									,<?php echo $ResultadoSolicitudesProcesadasConteo->return;
									}
							}
						}
						else{
							//Obtengo el id del analista
							$id=$ResultadoSolicitudesProcesadasXAnalista->return->idanalista;
							//Lo convierto en array
							$idAnalista=array('idAnalista' => $id);
							//Llamo al servicio que cuenta cuantas solicitudes fueron procesadas por cada analista 
							$ResultadoSolicitudesProcesadasConteo = $client->contarSHXidAnalista($idAnalista);
							?>
								<?php echo $ResultadoSolicitudesProcesadasConteo->return ?>
							<?php }
						
					?>
				]
    
            }]
        });
		
		
		
		/*Gráfico del total de las solicitudes contra las solicitudes asignadas y no asignadas*/
        $('#containerDos').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Solicitudes'
            },
            xAxis: {
                categories: [
					'Asignadas',
					'No Asignadas'
                ]
            },
            yAxis: {
                min: 0,
				max: <?php echo $ResultadoTotalSolicitudes->return ?>,
                title: {
                    text: 'Cantidad Total'
                }
            },
             tooltip: {
                headerFormat: '<span style="font-size:8px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0"> </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.1,
                    borderWidth: 0
                }
            },
            series: [{
				name: 'Total',
                data: [
					<?php echo $ResultadoColaHoy->return ?>,
					<?php echo $ResultadoTotalSolicitudes->return-$ResultadoColaHoy->return ?>
					]
    
            }]
        });
		
    });
	</script>
    
    <!-- script de paginacion -->
	<script src="footable/js/footable.js" type="text/javascript"></script>
	<script src="footable/js/footable.paginate.js" type="text/javascript"></script>
	<script src="footable/js/footable.sortable.js" type="text/javascript"></script>
 
  	<script type="text/javascript">
    	$(function() {
      		$('table').footable();
    	});
  	</script>
    </body>
</html>
