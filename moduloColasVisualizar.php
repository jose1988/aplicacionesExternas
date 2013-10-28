<?php
session_start();

//Verifico si ha iniciado sesión sino lo redirecciono al moduloColasLogin.php
include("/recursos/funciones.php");
if(!existeSesion()){
	iraURL("moduloColasLogin.php");
}

  	$wsdl_url = 'http://localhost:15362/HoriFarmacia/WS_Niuska?WSDL';
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
                        	<th align="left"><p>&nbsp;</p></th>
                            <td align="right"><p>&nbsp;</p></td>
                        </tr>
                        <tr>
                        	<th align="left">Operadores Conectados: </th>
                            <td align="right"><?php echo $ResultadoOperadoresConectados->return ?></td>
                		</tr>
                        <tr>
                        	<th align="left"><p>&nbsp;</p></th>
                            <td align="right"><p>&nbsp;</p></td>
                        </tr>
                        <tr>
                        	<th align="left">Solicitudes Procesadas: </th>
                            <td align="right"><?php echo $ResultadoSolicitudesProcesadas->return ?></td>
                		</tr>
				</tbody>
          </table>
        </div>
       <div class="span10">
       		<div class="span5">
       		</br>
       		</br>
        <?php 
			//Verificando que no este vacio o no sea null
			if(isset($ResultadoSolicitudesProcesadasXAnalista->return)){
		?>
       
       		<table class="table table-bordered table-striped" width="70%">
        		<thead bgcolor="#B9B9B9">
        			<tr>
            			<th style="text-align:center">Operador</th>
                		<th style="text-align:center">Solicitudes Procesadas</th>
                		<th style="text-align:center">Visualizar</th>
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
             <?php
             }
			 //Sino existen registros no muestro la tabla
			 else{?>
				 <div class="alert alert-block" align="center">
   					<h2 style="color:rgb(255,255,255)" align="center">Atención</h2>
    				<h4 align="center">No Existen Registros</h4>
   			     </div>
				 <?php }?>
       		</div>
       
       		<div class="span4">
       			<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
        		</div>
       		</div>
       </div>
       
       </div>
	</div>
    
    <!-- /container -->
	<div id="footer" class="container">    	
	</div>
 </div>
  	
    <script> /*Función del gráfico*/
	$(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Average Rainfall'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    
            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
    
            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
    
            }, {
                name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
    
            }]
        });
    });
	</script>
    </body>
</html>
